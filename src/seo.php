<?php
/**
 * Ballonsport Krohmer — SEO-Helper
 *
 * seo_head() rendert den kompletten <head>-Block inkl. JSON-LD.
 *
 * Unterstützte $args-Schlüssel:
 *   title             (string)  — Seitentitel (wird mit Site-Name kombiniert)
 *   description       (string)  — Meta-Description
 *   canonical         (string)  — Kanonische URL (optional, Default: site_url)
 *   og_image_key      (string)  — Image-Key für og:image (Default: og_default)
 *   json_ld           (array)   — Erstes JSON-LD-Objekt (überschreibt LocalBusiness)
 *   extra_json_ld     (array[]) — Weitere JSON-LD-Blöcke als Array von Arrays
 *   noindex           (bool)    — Falls true: noindex,nofollow
 *   preload_image_key (string)  — Image-Key des LCP-Hero-Bildes → <link rel="preload" as="image">
 *   breadcrumbs       (array)   — BreadcrumbList-Daten [['name'=>'...','url'=>'...'],...]
 *   critical_css      (string)  — Above-the-fold CSS, inline in <style> eingebettet
 *   osm               (bool)    — Falls true: Preconnect für OpenStreetMap hinzufügen
 */
function seo_head(array $args = []): void
{
    global $CFG;

    $siteName  = e($CFG['site_name']  ?? 'Ballonsport Krohmer');
    $siteUrl   = rtrim($CFG['site_url'] ?? 'https://www.ballonsport-krohmer.de', '/');
    $phone     = $CFG['contact_phone'] ?? '+49 7127 21173';
    $email     = $CFG['contact_email'] ?? 'info@ballonsport-krohmer.de';

    $pageTitle       = $args['title']             ?? '';
    $description     = $args['description']       ?? 'Ballonsport Krohmer — Heißluftballonfahrten über der Schwäbischen Alb seit 1998. Reutlingen, Tübingen, Stuttgart.';
    $canonical       = $args['canonical']         ?? $siteUrl . '/';
    $ogImageKey      = $args['og_image_key']      ?? 'og_default';
    $noindex         = !empty($args['noindex']);
    $preloadImageKey = $args['preload_image_key'] ?? '';
    $criticalCss     = $args['critical_css']      ?? '';
    $osmPreconnect   = !empty($args['osm']);
    $breadcrumbs     = $args['breadcrumbs']       ?? [];
    $extraJsonLd     = $args['extra_json_ld']     ?? [];

    // Seitentitel zusammenstellen
    $fullTitle = $pageTitle !== ''
        ? e($pageTitle) . ' — ' . $siteName
        : $siteName . ' — Ballonfahrten über der Schwäbischen Alb';

    // OG-Bild-URL
    $ogImageUrl = $siteUrl . img_url($ogImageKey);

    // JSON-LD — LocalBusiness als Basis
    $jsonLd = $args['json_ld'] ?? [
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => 'Ballonsport Krohmer',
        'description' => 'Heißluftballonfahrten über der Schwäbischen Alb seit 1998.',
        'url'         => $siteUrl . '/',
        'telephone'   => $phone,
        'email'       => $email,
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Carl-Zeiss-Straße 3',
            'addressLocality' => 'Pliezhausen',
            'postalCode'      => '72124',
            'addressCountry'  => 'DE',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => 48.5447,
            'longitude' => 9.2247,
        ],
        'openingHoursSpecification' => [
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'opens'     => '08:00',
                'closes'    => '12:00',
            ],
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'opens'     => '14:00',
                'closes'    => '17:00',
            ],
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Friday'],
                'opens'     => '08:00',
                'closes'    => '12:00',
            ],
        ],
        'sameAs' => [],
    ];

    $robotsContent = $noindex ? 'noindex,nofollow' : 'index,follow';

    // BreadcrumbList JSON-LD
    $breadcrumbJsonLd = null;
    if (!empty($breadcrumbs)) {
        $breadcrumbItems = [];
        foreach ($breadcrumbs as $idx => $crumb) {
            $breadcrumbItems[] = [
                '@type'    => 'ListItem',
                'position' => $idx + 1,
                'name'     => $crumb['name'],
                'item'     => str_starts_with($crumb['url'], 'http')
                    ? $crumb['url']
                    : $siteUrl . '/' . ltrim($crumb['url'], '/'),
            ];
        }
        $breadcrumbJsonLd = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $breadcrumbItems,
        ];
    }

    // Ausgabe
    ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $fullTitle ?></title>
    <meta name="description" content="<?= e($description) ?>">
    <meta name="robots" content="<?= $robotsContent ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">

    <!-- Open Graph -->
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="<?= $siteName ?>">
    <meta property="og:title"       content="<?= $fullTitle ?>">
    <meta property="og:description" content="<?= e($description) ?>">
    <meta property="og:url"         content="<?= e($canonical) ?>">
    <meta property="og:image"       content="<?= e($ogImageUrl) ?>">
    <meta property="og:locale"      content="de_DE">

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?= $fullTitle ?>">
    <meta name="twitter:description" content="<?= e($description) ?>">
    <meta name="twitter:image"       content="<?= e($ogImageUrl) ?>">

    <!-- Mobile Browser Chrome -->
    <meta name="theme-color" content="#0EA5E9">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= e(asset('/assets/img/logo.svg')) ?>">

<?php if ($osmPreconnect): ?>
    <!-- Preconnect für OpenStreetMap (nur auf Seiten mit eingebetteter Karte) -->
    <link rel="preconnect" href="https://www.openstreetmap.org" crossorigin>
    <link rel="dns-prefetch" href="https://www.openstreetmap.org">
<?php endif; ?>

<?php if ($criticalCss !== ''): ?>
    <!-- Critical CSS (Above-the-fold, inline) -->
    <style><?= $criticalCss ?></style>
<?php endif; ?>

    <!-- Stylesheet preload + load -->
    <link rel="preload" href="<?= e(asset('/assets/css/styles.css')) ?>" as="style">
    <link rel="stylesheet" href="<?= e(asset('/assets/css/styles.css')) ?>">

<?php if (defined('ROOT') && file_exists(ROOT . '/public/assets/fonts/Inter.var.woff2')): ?>
    <!-- Inter Variable Font preload -->
    <link rel="preload" as="font" type="font/woff2" href="/assets/fonts/Inter.var.woff2" crossorigin>
<?php endif; ?>

<?php if ($preloadImageKey !== ''): ?>
    <!-- LCP-Bild preload -->
<?php
    $preloadRow      = (_image_cache())[$preloadImageKey] ?? null;
    $preloadFilename = $preloadRow['filename'] ?? '';
    $preloadVariants = _img_variants_info($preloadFilename);
    if ($preloadVariants !== null):
        $pvDir      = $preloadVariants['uploadDir'];
        $pvBase     = $preloadVariants['basename'];
        $pvSrcset   = _img_srcset($pvDir, $pvBase, 'webp');
        if ($pvSrcset === '') {
            $pvSrcset = _img_srcset($pvDir, $pvBase, 'jpg');
        }
?>
    <link rel="preload" as="image" imagesrcset="<?= e($pvSrcset) ?>" imagesizes="100vw">
<?php else: ?>
    <link rel="preload" as="image" href="<?= e(img_url($preloadImageKey)) ?>">
<?php endif; ?>
<?php endif; ?>

    <!-- JSON-LD Structured Data — LocalBusiness -->
    <script type="application/ld+json">
<?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>

<?php if ($breadcrumbJsonLd !== null): ?>
    <!-- JSON-LD Structured Data — BreadcrumbList -->
    <script type="application/ld+json">
<?= json_encode($breadcrumbJsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
<?php endif; ?>

<?php foreach ($extraJsonLd as $extraBlock): ?>
    <!-- JSON-LD Structured Data — Zusatz -->
    <script type="application/ld+json">
<?= json_encode($extraBlock, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
<?php endforeach; ?>

<?php
}
// Hinweis: seo_head() gibt keine </head> oder <body> aus — das übernimmt header.php
