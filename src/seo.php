<?php
/**
 * Ballonsport Krohmer — SEO-Helper
 *
 * seo_head() rendert den kompletten <head>-Block inkl. JSON-LD.
 *
 * Unterstützte $args-Schlüssel:
 *   title        (string)  — Seitentitel (wird mit Site-Name kombiniert)
 *   description  (string)  — Meta-Description
 *   canonical    (string)  — Kanonische URL (optional, Default: site_url)
 *   og_image_key (string)  — Image-Key für og:image (Default: og_default)
 *   json_ld      (array)   — Zusätzliches JSON-LD-Objekt (überschreibt LocalBusiness)
 *   noindex      (bool)    — Falls true: noindex,nofollow
 */
function seo_head(array $args = []): void
{
    global $CFG;

    $siteName  = e($CFG['site_name']  ?? 'Ballonsport Krohmer');
    $siteUrl   = rtrim($CFG['site_url'] ?? 'https://www.ballonsport-krohmer.de', '/');
    $phone     = $CFG['contact_phone'] ?? '+49 7127 21173';
    $email     = $CFG['contact_email'] ?? 'info@ballonsport-krohmer.de';

    $pageTitle   = $args['title']       ?? '';
    $description = $args['description'] ?? 'Ballonsport Krohmer — Heißluftballonfahrten über der Schwäbischen Alb seit 1998. Reutlingen, Tübingen, Stuttgart.';
    $canonical   = $args['canonical']   ?? $siteUrl . '/';
    $ogImageKey  = $args['og_image_key'] ?? 'og_default';
    $noindex     = !empty($args['noindex']);

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

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/img/logo.svg">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="/assets/css/styles.css">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
<?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
<?php
}
// Hinweis: seo_head() gibt keine </head> oder <body> aus — das übernimmt header.php
