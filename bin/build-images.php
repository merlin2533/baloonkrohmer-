<?php
/**
 * Ballonsport Krohmer — Responsive-Bild-Build
 *
 * Erzeugt aus den Original-JPGs in public/uploads/ responsive Varianten:
 *   <basename>-480.jpg / .webp
 *   <basename>-960.jpg / .webp
 *   <basename>-1600.jpg / .webp
 *
 * Galerie-Bilder erhalten zusätzlich:
 *   <basename>-thumb.jpg / .webp  (600×600 center-crop)
 *
 * Logo (logo.png) bekommt nur logo.webp (kein Resize).
 *
 * Idempotent: existierende Varianten werden übersprungen, außer wenn das
 * Original neuer ist (filemtime-Vergleich).
 *
 * Verwendung:
 *   php bin/build-images.php
 */

declare(strict_types=1);

const WIDTHS       = [480, 960, 1600];
const JPG_QUALITY  = 82;
const WEBP_QUALITY = 80;
const THUMB_SIZE   = 600;

$uploadDir = __DIR__ . '/../public/uploads';

// -------------------------------------------------------------------------
// Hilfsfunktionen
// -------------------------------------------------------------------------

/**
 * Erstellt ein resiztes Bild (GD-Ressource) aus einem vorhandenen Bild.
 * Gibt null zurück, wenn das Original schmäler als $targetW ist.
 *
 * @return \GdImage|null
 */
function resize_image(\GdImage $src, int $srcW, int $srcH, int $targetW): ?\GdImage
{
    if ($srcW <= $targetW) {
        return null; // kein Upscaling
    }
    $targetH = (int) round($srcH * ($targetW / $srcW));
    $dst = imagecreatetruecolor($targetW, $targetH);
    if ($dst === false) {
        return null;
    }
    // Transparenz erhalten (für PNG-Quellen)
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $targetW, $targetH, $srcW, $srcH);
    return $dst;
}

/**
 * Erstellt ein quadratisches Center-Crop-Bild der Größe $size × $size.
 *
 * @return \GdImage
 */
function thumb_crop(\GdImage $src, int $srcW, int $srcH, int $size): \GdImage
{
    $dst = imagecreatetruecolor($size, $size);
    // Hintergrundfarbe (für JPEGs ohne Transparenz egal, aber sicher)
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);

    // Seitenverhältnis: welche Seite ist der begrenzende Faktor?
    $ratio = $srcW / $srcH;
    if ($ratio > 1) {
        // Breit: Höhe passt, Breite croppen
        $cropH = $srcH;
        $cropW = $srcH; // quadrat aus Höhe
        $srcX  = (int) round(($srcW - $cropW) / 2);
        $srcY  = 0;
    } else {
        // Hoch oder quadrat: Breite passt
        $cropW = $srcW;
        $cropH = $srcW;
        $srcX  = 0;
        $srcY  = (int) round(($srcH - $cropH) / 2);
    }

    imagecopyresampled($dst, $src, 0, 0, $srcX, $srcY, $size, $size, $cropW, $cropH);
    return $dst;
}

/**
 * Speichert eine GdImage als JPG und/oder WebP.
 * Gibt die Anzahl der tatsächlich geschriebenen Dateien zurück.
 */
function save_variants(\GdImage $img, string $basePath, bool $doJpg = true, bool $doWebp = true): int
{
    $written = 0;
    if ($doJpg) {
        imagejpeg($img, $basePath . '.jpg', JPG_QUALITY);
        $written++;
    }
    if ($doWebp) {
        imagewebp($img, $basePath . '.webp', WEBP_QUALITY);
        $written++;
    }
    return $written;
}

/**
 * Lädt ein Bild abhängig vom MIME-Typ.
 *
 * @return array{0:\GdImage,1:int,2:int}|null
 */
function load_image(string $path): ?array
{
    $info = @getimagesize($path);
    if ($info === false) {
        return null;
    }
    $mime = $info['mime'];
    $img = match ($mime) {
        'image/jpeg' => @imagecreatefromjpeg($path),
        'image/png'  => @imagecreatefrompng($path),
        'image/webp' => @imagecreatefromwebp($path),
        default      => false,
    };
    if ($img === false) {
        return null;
    }
    return [$img, $info[0], $info[1]];
}

/**
 * Prüft ob eine Zieldatei bereits aktuell ist (existiert UND nicht älter als
 * das Original).
 */
function is_up_to_date(string $targetPath, int $srcMtime): bool
{
    if (!file_exists($targetPath)) {
        return false;
    }
    $mtime = @filemtime($targetPath);
    return $mtime !== false && $mtime >= $srcMtime;
}

// -------------------------------------------------------------------------
// Logo (logo.png) → nur logo.webp
// -------------------------------------------------------------------------
$logoPath    = $uploadDir . '/logo.png';
$logoWebp    = $uploadDir . '/logo.webp';
$logoCreated = 0;

if (file_exists($logoPath)) {
    $srcMtime = (int) filemtime($logoPath);
    if (is_up_to_date($logoWebp, $srcMtime)) {
        echo "SKIP logo.png (bereits aktuell)\n";
    } else {
        $loaded = load_image($logoPath);
        if ($loaded !== null) {
            [$img] = $loaded;
            imagewebp($img, $logoWebp, WEBP_QUALITY);
            imagedestroy($img);
            $logoCreated = 1;
            echo "OK   logo.png → erzeugt: 1 Variante (logo.webp)\n";
        } else {
            echo "FEHLER: Konnte logo.png nicht laden\n";
        }
    }
} else {
    echo "SKIP logo.png (nicht gefunden)\n";
}

// -------------------------------------------------------------------------
// JPGs verarbeiten
// -------------------------------------------------------------------------
$jpgFiles = glob($uploadDir . '/*.jpg');
if ($jpgFiles === false) {
    $jpgFiles = [];
}
sort($jpgFiles);

$totalJpg  = 0;
$totalWebp = 0;

foreach ($jpgFiles as $srcPath) {
    $filename = basename($srcPath);
    $basename = pathinfo($filename, PATHINFO_FILENAME);

    // Bereits generierte Varianten überspringen (erkennbar am Suffix)
    if (preg_match('/-(480|960|1600|thumb)$/', $basename)) {
        continue;
    }

    $srcMtime  = (int) filemtime($srcPath);
    $isGallery = (bool) preg_match('/^gallery_\d+$/', $basename);

    $loaded = null; // Lazy-load: nur öffnen wenn wirklich nötig
    $created = 0;

    // --- Breiten-Varianten ---
    foreach (WIDTHS as $width) {
        $targetBase = $uploadDir . '/' . $basename . '-' . $width;
        $needJpg    = !is_up_to_date($targetBase . '.jpg', $srcMtime);
        $needWebp   = !is_up_to_date($targetBase . '.webp', $srcMtime);

        if (!$needJpg && !$needWebp) {
            continue;
        }

        // Bild laden, falls noch nicht geschehen
        if ($loaded === null) {
            $loaded = load_image($srcPath);
            if ($loaded === null) {
                echo "FEHLER: Konnte $filename nicht laden\n";
                break;
            }
        }

        [$srcImg, $srcW, $srcH] = $loaded;

        $resized = resize_image($srcImg, $srcW, $srcH, $width);
        if ($resized === null) {
            // Bild zu klein für diese Breite → überspringen
            continue;
        }

        $written = save_variants($resized, $targetBase, $needJpg, $needWebp);
        imagedestroy($resized);

        if ($needJpg) {
            $totalJpg++;
            $created++;
        }
        if ($needWebp) {
            $totalWebp++;
            $created++;
        }
    }

    // --- Galerie-Thumb ---
    if ($isGallery) {
        $thumbBase = $uploadDir . '/' . $basename . '-thumb';
        $needJpg   = !is_up_to_date($thumbBase . '.jpg', $srcMtime);
        $needWebp  = !is_up_to_date($thumbBase . '.webp', $srcMtime);

        if ($needJpg || $needWebp) {
            if ($loaded === null) {
                $loaded = load_image($srcPath);
                if ($loaded === null) {
                    echo "FEHLER: Konnte $filename nicht laden\n";
                    continue;
                }
            }
            [$srcImg, $srcW, $srcH] = $loaded;
            $thumb = thumb_crop($srcImg, $srcW, $srcH, THUMB_SIZE);
            $written = save_variants($thumb, $thumbBase, $needJpg, $needWebp);
            imagedestroy($thumb);

            if ($needJpg) {
                $totalJpg++;
                $created++;
            }
            if ($needWebp) {
                $totalWebp++;
                $created++;
            }
        }
    }

    if ($loaded !== null) {
        [$srcImg] = $loaded;
        imagedestroy($srcImg);
    }

    if ($created > 0) {
        echo "OK   $filename → erzeugt: $created Varianten\n";
    } else {
        echo "SKIP $filename (bereits aktuell)\n";
    }
}

// -------------------------------------------------------------------------
// Zusammenfassung
// -------------------------------------------------------------------------
echo "---\n";
echo "Fertig. JPG-Varianten: {$totalJpg}   WebP-Varianten: {$totalWebp}\n";
