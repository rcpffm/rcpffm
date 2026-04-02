<?php
// ============================================================
//  BRUTALSUCHE_File.php  v03.06
//  (c) rcpffm – AGPL-3.0
//  https://www.gnu.org/licenses/agpl-3.0.html
//
//  Part of GRAPPA FREE FRAMEWORK
//  https://github.com/rcpffm
//
//  RESILIENCE BY DESIGN – No Single Point of Failure
//  Designed for distributed, censorship-resistant deployment.
//
//  NEU v03.06:
//    + Grep erkennt /pattern/ als Regex · /(Lao|Hegel)/ funktioniert · G-01
//    + Grep-Fehler-Banner bei ungueltigem Regex · G-02
//    + Grep-Placeholder zeigt Beispiele · G-03
//
//  NEU v03.05:
//    + Regex-Delimiter auto-normalisieren: \.(html|php)$ → /\.(html|php)$/ · R-01
//    + Glob-Modus: Multi-Pattern per Leerzeichen · *.html *.php matcht beide · R-02
//    + Schnellwahl-Buttons liefern korrekten Delimiter · R-03
//    + LS_KEY auf v0305 aktualisiert · R-04
//    + Dateiname-Klick: oeffnet Datei in neuem Tab (confirm) · Suche vorher in LS+URL · F-01
//
//  NEU v03.04:
//    + Regex-Validierung: ungueltige Regex → Fehlermeldung statt 0 Dateien · P-01
//    + Pattern-Schnellwahl-Buttons: html · php · json · html+php · alle · P-02
//    + Placeholder verbessert: Beispiele direkt sichtbar · P-03
//    + Pattern-Fehler-Banner im UI · P-04
//
//  NEU v03.03:
//    + Default-Filter: ohne Pattern nur html/php/json/jsontxt/md · kein 769-Dateien-Dump · F-01
//    + ART-Nr Index: Links zu GRAPPABRUTAL_JSON_SmartFilter_Editor.php?JsonPfadName= · F-02
//    + check_art: JSON-Spalte -> SmartFilter-Link statt Roh-URL · F-03
//    + Pills aktiv = gruen (war blau) · F-04
//
//  NEU v03.02:
//    + URL-Persistenz-Fix: action nach Ausfuehrung per replaceState entfernt · U-01
//    + URL-Persistenz-Fix: lastfile/lastdir tote Parameter entfernt · U-02
//    + URL-Persistenz-Fix: keylist korrekt in baseParams gesichert · U-03
//    + ?action=check_art · ART-Konsistenzpruefung HTML+PHP vs JSON · C-01
//      - Nur hoechste Version je Basisname (Versionsstring _vXX.YY) · C-02
//      - Drei Klassen: OK / Drift / JSON fehlt · C-03
//      - Alle Dateinamen als anklickbare Links in ./ · C-04
//    + alle v03.01-Features integriert
//
//  NEU v03.01:
//    + SEO-Felder in importantValues() · §22.12 · B-01
//    + SEO-Meta-Tags aus IV · DOM-Patches · nicht hardcoded · B-02/B-06
//    + datei_php in validateImportantValues() · B-03
//    + validateImportantValues() vollstaendig implementiert · B-04
//    + art_nr (IV) <=> art (JSON) Bridge · §34.5 Uebergangsregel · B-05
//    + buildGrappaArtifact() liefert SEO-Felder vollstaendig · B-07
//    + calc_ggstc_php() nur einmal aufgerufen · B-08
//    + Index-Generator Stub: OP-34a Arbeitsdateien-Regex dokumentiert · B-09
//    + migration_key -> OPL verschoben · B-10
//    + Index-Generator Stub vollstaendig dokumentiert · OP-34 Ansatzpunkt
//    + alle v03.00-Features integriert
//
//  #TAG:GRAPPA-STD #AUTHOR:rcpffm #UTC:2026-03-29T12:00:00Z
//  #VER:v03.06 #GRAPPA:fw v08.00 #LICENSE:AGPL-3.0
//  #ENCODING:UTF-8-NO-BOM
//  #ART:ART-2026-0317-172900.0000
//
//  Cpt. Kirk here 🖖
//  GGSTC at load: siehe calc_ggstc_php()
//  "To boldly go where no framework has gone before."
//  — aber das Grappa-Framework fliegt trotzdem. 🥃
//
//  NICHT für: Überwachung · Zensur · Autoritäre Regime
//  NOT for:   Surveillance · Censorship · Authoritarian use
//             Putin · Xi · Orbán · MAGA-Oligarchs
// ============================================================

// ── GGSTC PHP-Fallback ──────────────────────────────────────
function calc_ggstc_php(): string {
    $now  = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    $year = (int)$now->format('Y');
    $doy  = (int)$now->format('z') + 1;
    $diy  = checkdate(2, 29, $year) ? 366 : 365;
    $sec  = (int)$now->format('H') * 3600
          + (int)$now->format('i') * 60
          + (int)$now->format('s');
    return number_format(
        ($year - 2323) * 1000 + ($doy / $diy) * 1000 + ($sec / 86400),
        4, '.', ''
    );
}
// B-08: einmalig aufrufen · nicht doppelt
$ggstc_static = calc_ggstc_php();

// ── importantValues() · GRAPPA-STD §22 · Single Source of Truth ──
/** @grappa importantValues — GRAPPA-STD §22 · ganz oben · Single Source of Truth */
function importantValues(): array {
    return [
        // ── IMMUTABLE — nie ändern nach Erstellung ──────────
        'art_nr'            => 'ART-2026-0317-172900.0000',
        // migration_key → OPL · B-10 · kein Pflichtfeld laut grappa_iv_vorlage_v01.02

        // ── VERSIONING — pro Release anpassen ───────────────
        'artikel_version'   => 'v03.06',
        'framework_version' => 'fw v08.00',
        'schema_version'    => 'v08.00-3',

        // ── METADATA ────────────────────────────────────────
        'titel'             => 'BRUTALSUCHE_File — GRAPPA Datei- und Inhaltssuche',
        'autor'             => 'rcpffm + Claude Sonnet 4.6 (Anthropic)',
        'lizenz'            => 'AGPL-3.0',
        'sprache'           => 'de',
        'tool_typ'          => 'PHP-Tool',
        'grappa_std'        => 'fw v08.00',

        // ── DATEINAME · §6.2 · XOR · nie datei_html gleichzeitig ──
        'datei_php'         => 'BRUTALSUCHE_File.php',

        // ── SEO · §22.12 · Child-Vorschlag · PO bestätigt ───
        // Workflow: Child schlägt vor → PO nickt ab → IV + JSON gleichzeitig
        // robots: noindex,nofollow — Tool · nicht öffentlicher Artikel
        'beschreibung'      => 'BRUTALSUCHE_File: Datei- und Inhaltssuche für das GRAPPA FREE FRAMEWORK. Glob, Regex, Grep, ART-Key-Index. rcpffm · AGPL-3.0.',
        'keywords'          => 'GRAPPA, BRUTALSUCHE, Dateisuche, Inhaltssuche, PHP-Tool, ART-Key, rcpffm, AGPL',
        'og_titel'          => 'BRUTALSUCHE_File — GRAPPA Datei- und Inhaltssuche',
        'og_beschreibung'   => 'Datei- und Inhaltssuche im GRAPPA FREE FRAMEWORK. Glob, Regex, Grep, ART-Key-Index, LocalStorage. rcpffm · AGPL-3.0.',

        // ── CHANGELOG — append-only · nie löschen ───────────
        'schema_changelog'  => [
            'v08.00-0: GRAPPA-Artikel Schema Initial',
            'v08.00-1: XOR logic datei_html/php · ARTnr index · Warnsystem · PO-Queue',
            'v08.00-2: Key-Liste Box · Auto-Regex · Steuerkey · dynamische URL-Parameter',
            'v08.00-3: CMS-Steuerung · Index-Generator-Stub · Mikrosekunden-ART-Nr · Dateiname-Sperrprotokoll · v03.00',
            'v08.00-3: SEO-Felder · validateImportantValues() · DOM-Patches · Index-Generator OP-34-Ansatz · v03.01',
            'v08.00-3: URL-Persistenz-Fixes · action=check_art ART-Konsistenzcheck · v03.02',
            'v08.00-3: Default-Filter GRAPPA-Ext · ART-Links SmartFilter · Pills gruen · v03.03',
            'v08.00-3: Regex-Validierung · Pattern-Schnellwahl · Fehler-Banner · v03.04',
            'v08.00-3: Regex-Delimiter auto · Glob Multi-Pattern · Datei-Oeffner · v03.05',
            'v08.00-3: Grep erkennt /pattern/ als Regex · Grep-Fehler-Banner · v03.06',
        ],

        // ── SEARCH PRESETS · für Auto-Regex in Key-Liste ────
        'search_presets'    => [
            'core_fields' => [
                'slug', 'artikel_version', 'titel', 'beschreibung',
                'subtitle', 'sprache', 'relatedTo', 'objekte', 'last_modified',
            ],
        ],

        // ── INDEX GENERATOR CONFIG · OP-34 · v03.01 Ansatz ──
        // Vollausbau in v03.02+ · PO-Entscheid OP-34
        'index_generator'   => [
            'template_placeholder_prefix' => '%%',
            'template_placeholder_suffix' => '%%',
            'bak_rotation_limit'          => 3,
            'sort_by'                     => 'last_modified',
            // last_modified kommt aus ART-KEY.json · nicht aus IV · §6.1 Architektur-MD
            // OP-34a: Arbeitsdateien-Regex beim Einlesen: _v\d{2}\.\d{2}\.(html|php|md|json)$
        ],

        // ── WARNSYSTEM ───────────────────────────────────────
        'warnsystem'        => [
            'critical_checks' => [
                'framework_mismatch' => true,
                'mandatory_fields'   => ['art_nr', 'datei_php', 'schema'],
            ],
            'warning_checks' => [
                'schema_deprecated'  => 'v08.00-0',
                'optional_missing'   => ['subtitle', 'flags', 'relatedTo'],
            ],
            'po_trigger'     => [
                'on_critical' => 'immediate',
                'on_warning'  => 'deferred',
                'log_file'    => 'GRAPPA-PO-QUEUE.json',
            ],
        ],
    ];
}
$iv = importantValues();

// ── generateArtNr() · Mikrosekunden · einmalig bei Artikelerstellung ──
// WICHTIG: Nie in importantValues() aufrufen · nur für neue Artikel/Tools
// Ergebnis hardcoded in IV['art_nr'] eintragen · §6.2 Architektur-MD
function generateArtNr(): string {
    $microtime = microtime(true);
    $micro = sprintf('%04d', (int)(($microtime - floor($microtime)) * 10000));
    $date = DateTimeImmutable::createFromFormat(
        'U.u',
        number_format($microtime, 6, '.', '')
    );
    $date = $date->setTimezone(new DateTimeZone('UTC'));
    return sprintf(
        'ART-%s-%s%s-%s%s%s.%s',
        $date->format('Y'),   // 2026
        $date->format('m'),   // 03
        $date->format('d'),   // 18
        $date->format('H'),   // 00
        $date->format('i'),   // 59
        $date->format('s'),   // 12
        $micro                // 3456
    );
    // → z.B. ART-2026-0318-005912.3456
}

// ── rotateBackups() ──────────────────────────────────────────
function rotateBackups(string $file, int $limit): void {
    for ($i = $limit - 1; $i >= 1; $i--) {
        $old = $file . ($i > 1 ? '.BAK.' . ($i - 1) : '.BAK');
        $new = $file . '.BAK.' . $i;
        if (file_exists($old)) rename($old, $new);
    }
    rename($file, $file . '.BAK');
}

// ── buildGrappaArtifact() · JSON-Schaltzentrale schreiben ────
// Aufruf: ?action=build_artifact (nur PO · nach Dummy-Deploy)
// B-07: SEO-Felder jetzt vollständig in IV → werden korrekt in JSON geschrieben
function buildGrappaArtifact(): array {
    $iv      = importantValues();
    $artNr   = $iv['art_nr'];
    $jsonFile = $artNr . '.json';
    $existing = [];

    if (file_exists($jsonFile)) {
        $raw = file_get_contents($jsonFile);
        if ($raw !== false) {
            $existing = json_decode($raw, true) ?? [];
        }
    }

    // array_replace_recursive · nicht array_merge_recursive
    // (merge_recursive würde Arrays wie schema_changelog doppeln)
    $merged = array_replace_recursive($existing, $iv);

    // art_nr aus existing hat Vorrang — immutable
    if (!empty($existing['art_nr'])) {
        $merged['art_nr'] = $existing['art_nr'];
    }

    // §34.5 Übergangsregel: art + key identisch · B-05
    $merged['art'] = $merged['art_nr'];
    $merged['key'] = $merged['art_nr'];

    // schema · slug · datei_php aus IV ableiten wenn noch nicht gesetzt
    if (empty($merged['schema'])) {
        $merged['schema'] = 'GRAPPA-Artikel v08.00';
    }
    if (empty($merged['slug'])) {
        $merged['slug'] = isset($iv['datei_php'])
            ? pathinfo($iv['datei_php'], PATHINFO_FILENAME)
            : '';
    }

    // last_modified aus JSON · nicht aus IV · §6.1
    $merged['last_modified'] = (new DateTimeImmutable('now', new DateTimeZone('UTC')))->format('c');

    // BAK-Rotation
    if (file_exists($jsonFile)) {
        rotateBackups($jsonFile, $iv['index_generator']['bak_rotation_limit']);
    }

    // JSON schreiben · LOCK_EX als 3. Argument · B-04 fix
    $written = file_put_contents(
        $jsonFile,
        json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );

    return [
        'success'   => $written !== false,
        'json_file' => $jsonFile,
        'art_nr'    => $merged['art_nr'],
        'version'   => $merged['artikel_version'],
    ];
}

// ── slugFromTitel() · §6.2 Dateiname-Sperrprotokoll ─────────
function slugFromTitel(string $titel): string {
    $slug = mb_strtolower($titel, 'UTF-8');
    $slug = str_replace(
        ['ä','ö','ü','ß','Ä','Ö','Ü'],
        ['ae','oe','ue','ss','ae','oe','ue'],
        $slug
    );
    $slug = preg_replace('/[^a-z0-9]+/', '_', $slug);
    $slug = trim($slug, '_');
    return $slug;
}

// ── Action-Handler ───────────────────────────────────────────
$action       = $_GET['action'] ?? '';
$actionResult = null;

if ($action === 'build_artifact') {
    $actionResult = buildGrappaArtifact();
}

if ($action === 'generate_art_nr') {
    $actionResult = ['new_art_nr' => generateArtNr()];
}

if ($action === 'slug_vorschlag') {
    $titel = $_GET['titel'] ?? '';
    $ext   = $_GET['ext']   ?? 'html';
    $slug  = slugFromTitel($titel);
    $actionResult = [
        'vorschlag'  => $slug . '.' . $ext,
        'hinweis'    => 'PO prüft ob Datei auf Host existiert · dann Dummy deployen · dann OK melden',
    ];
}

// ── Parameter ────────────────────────────────────────────────
$pattern       = $_GET['pattern']   ?? '';
$sort          = $_GET['sort']      ?? 'mtime';
$dirSort       = $_GET['dir']       ?? 'desc';
$regexParam    = $_GET['regex']     ?? '0';   // BUGFIX v02.06: '0' statt ''
$useRegex      = in_array($regexParam, ['1', 'y', 'j'], true);
$filterNoCase  = isset($_GET['fnc']) ? ($_GET['fnc'] === '1') : true;
$grepStr       = $_GET['grep']      ?? '';
$grepNoCase    = isset($_GET['gnc']) ? ($_GET['gnc'] === '1') : true;
$grepWholeFile = isset($_GET['gwf']) ? ($_GET['gwf'] === '1') : false;
$keyList       = $_GET['keylist']   ?? '';
// U-02: lastfile/lastdir entfernt · waren tote Parameter ohne URL-Rueckfuehrung

// Auto-Regex aus Key-Liste
$autoGeneratedRegex = '';
if ($keyList !== '' && $grepStr === '') {
    $keys = array_filter(array_map('trim', explode("\n", $keyList)));
    if (count($keys) > 0) {
        $lookaheads = array_map(fn($k) => '(?=.*"' . preg_quote($k, '/') . '":)', $keys);
        $autoGeneratedRegex = '/^' . implode('', $lookaheads) . '/s';
        $grepStr = $autoGeneratedRegex;
    }
}

// ── U-02: lastfile/lastdir entfernt · waren tote Parameter ──────
// $lastFile und $lastDir werden nicht mehr als URL-Parameter verwendet

// ── C-01: check_art · ART-Konsistenzpruefung HTML+PHP <=> JSON ──────
// Liest alle .html + .php im Verzeichnis.
// C-02: Bei mehreren Dateien gleichem Basisname (nur Versionsstring _vXX.YY
//        unterschiedlich) wird nur die hoeChste Version herangezogen.
// Extrahiert art_nr aus importantValues() via Regex.
// Sucht zugehoerige [ART-NR].json und prueft art/key-Felder.
// C-03: Drei Ergebnis-Klassen: ok / drift / no_json
// C-04: Dateinamen als anklickbare Links in ./

function extractArtNrFromFile(string $absPath): ?string {
    $content = @file_get_contents($absPath);
    if ($content === false) return null;
    // PHP: 'art_nr' => 'ART-...'
    if (preg_match("/'art_nr'\s*=>\s*'(ART-\d{4}-\d{4}-\d{6}\.\d{4})'/", $content, $m)) {
        return $m[1];
    }
    // JS: art_nr: 'ART-...' oder art_nr: "ART-..."
    if (preg_match('/["\']?art_nr["\']?\s*:\s*["\']?(ART-\d{4}-\d{4}-\d{6}\.\d{4})["\']?/', $content, $m)) {
        return $m[1];
    }
    // HTML/JS: var _artNr = 'ART-...'
    if (preg_match('/["\']?(ART-\d{4}-\d{4}-\d{6}\.\d{4})["\']?/', $content, $m)) {
        return $m[1];
    }
    return null;
}

// Hilfsfunktion: Versionsnummer aus Dateiname extrahieren fuer Vergleich
// z.B. sge_riera_v02.03.html -> [2,3], ki_und_die_kleinen.html -> [0,0]
function extractVersionFromName(string $name): array {
    if (preg_match('/_v(\d+)[\._](\d+)\.[a-z]+$/i', $name, $m)) {
        return [(int)$m[1], (int)$m[2]];
    }
    return [0, 0];
}

function runCheckArt(string $dir, string $docRoot): array {
    $scanItems = @scandir($dir) ?: [];
    $candidates = []; // basename => ['name'=>..., 'ver'=>[major,minor]]

    foreach ($scanItems as $item) {
        $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
        if (!in_array($ext, ['html', 'php'], true)) continue;
        // Arbeitsdateien (mit _vXX.YY) sind AUCH gueltige Kandidaten --
        // wir wollen gerade die finden. Aber wir nehmen nur die hoechste.
        // Basisname = alles bis zum letzten _vXX.YY oder bis zur Extension
        if (preg_match('/^(.+?)(_v\d+[\._]\d+)?\.' . $ext . '$/i', $item, $m)) {
            $base = strtolower($m[1] . '.' . $ext);
        } else {
            $base = strtolower($item);
        }
        $ver = extractVersionFromName($item);
        if (!isset($candidates[$base])) {
            $candidates[$base] = ['name' => $item, 'ver' => $ver];
        } else {
            // Hoechste Version gewinnt
            $cur = $candidates[$base]['ver'];
            if ($ver[0] > $cur[0] || ($ver[0] === $cur[0] && $ver[1] > $cur[1])) {
                $candidates[$base] = ['name' => $item, 'ver' => $ver];
            }
        }
    }

    $results = [];
    foreach ($candidates as $base => $info) {
        $fname   = $info['name'];
        $absPath = $dir . DIRECTORY_SEPARATOR . $fname;
        $artNr   = extractArtNrFromFile($absPath);

        if ($artNr === null) {
            // Kein art_nr gefunden -> nicht GRAPPA-konform, ueberspringen
            continue;
        }

        $jsonFile    = $dir . DIRECTORY_SEPARATOR . $artNr . '.json';
        $jsonExists  = file_exists($jsonFile);
        $jsonArt     = null;
        $jsonKey     = null;
        $jsonVersion = null;

        if ($jsonExists) {
            $raw  = @file_get_contents($jsonFile);
            $data = $raw !== false ? (json_decode($raw, true) ?? []) : [];
            $jsonArt     = $data['art']              ?? null;
            $jsonKey     = $data['key']              ?? null;
            $jsonVersion = $data['artikel_version']  ?? null;
        }

        // Klasse bestimmen
        if (!$jsonExists) {
            $klasse = 'no_json';
        } elseif ($jsonArt === $artNr || $jsonKey === $artNr) {
            $klasse = 'ok';
        } else {
            $klasse = 'drift';
        }

        $results[] = [
            'datei'       => $fname,
            'art_nr_iv'   => $artNr,
            'json_datei'  => $artNr . '.json',
            'json_exists' => $jsonExists,
            'json_art'    => $jsonArt,
            'json_key'    => $jsonKey,
            'json_version'=> $jsonVersion,
            'klasse'      => $klasse,
        ];
    }

    // Sortierung: drift + no_json zuerst, dann ok
    usort($results, function($a, $b) {
        $order = ['drift' => 0, 'no_json' => 1, 'ok' => 2];
        return ($order[$a['klasse']] ?? 9) <=> ($order[$b['klasse']] ?? 9);
    });

    return $results;
}

$checkArtResults = null;
if ($action === 'check_art') {
    $checkArtResults = runCheckArt($currentAbs, $docRoot);
}

// ── Directory Setup ──────────────────────────────────────────
$docRoot      = realpath($_SERVER['DOCUMENT_ROOT']);
$rawSubdir    = $_GET['subdir'] ?? '.';
$requestedAbs = realpath($rawSubdir);
if ($requestedAbs === false) $requestedAbs = $docRoot;
if (strpos($requestedAbs . DIRECTORY_SEPARATOR, $docRoot . DIRECTORY_SEPARATOR) !== 0
    && $requestedAbs !== $docRoot) {
    $requestedAbs = $docRoot;
}
$currentAbs = $requestedAbs;
$relDisplay = ($currentAbs === $docRoot)
    ? './'
    : './' . ltrim(str_replace($docRoot, '', $currentAbs), DIRECTORY_SEPARATOR);
$parentAbs = realpath($currentAbs . DIRECTORY_SEPARATOR . '..');
$hasParent = ($parentAbs !== false && $parentAbs !== $currentAbs
    && strpos($parentAbs . DIRECTORY_SEPARATOR, $docRoot . DIRECTORY_SEPARATOR) === 0);

// ── File Scanning ─────────────────────────────────────────────
$fileInfo = [];
$subdirs  = [];
$scanItems = @scandir($currentAbs) ?: [];
foreach ($scanItems as $item) {
    if ($item === '.' || $item === '..') continue;
    $absItem = $currentAbs . DIRECTORY_SEPARATOR . $item;
    if (is_dir($absItem)) {
        $subdirs[] = $item;
    } else {
        $ct = @filectime($absItem) ?: 1;
        $mt = @filemtime($absItem) ?: 1;
        $fileInfo[] = [
            'name'   => $item,
            'ctime'  => $ct,
            'mtime'  => $mt,
            'ext'    => strtolower(pathinfo($item, PATHINFO_EXTENSION)),
            'hidden' => ($item[0] === '.'),
        ];
    }
}
sort($subdirs);

// ── Helper Functions ──────────────────────────────────────────
function buildUrl(array $params): string {
    return '?' . http_build_query(array_filter($params, fn($v) => $v !== '' && $v !== null && $v !== false));
}
function nextDir(string $col, string $cs, string $cd): string {
    return ($cs === $col) ? (($cd === 'asc') ? 'desc' : 'asc') : 'asc';
}
function headerLink(string $label, string $col, string $cs, string $cd, array $bp): string {
    $isActive = ($cs === $col);
    $arrow = $isActive ? ($cd === 'asc' ? ' <span class="arrow-active">▲</span>' : ' <span class="arrow-active">▼</span>') : '';
    $cls = 'th-link ' . ($isActive ? 'active' : 'inactive');
    $url = buildUrl(array_merge($bp, ['sort' => $col, 'dir' => nextDir($col, $cs, $cd)]));
    return '<a class="' . $cls . '" href="' . htmlspecialchars($url) . '">' . htmlspecialchars($label) . $arrow . '</a>';
}
function colorClass(string $ext): string {
    return in_array($ext, ['htm', 'html', 'php'], true) ? 'light-green' : 'dark-green';
}
function globToRegex(string $glob, bool $ci = false): string|false {
    $regex = ''; $inClass = false; $len = strlen($glob);
    for ($i = 0; $i < $len; $i++) {
        $c = $glob[$i];
        switch ($c) {
            case '*': $regex .= '.*'; break;
            case '?': $regex .= '.'; break;
            case '[':
                if ($inClass) return false;
                $inClass = true; $regex .= '[';
                if ($i + 1 < $len && in_array($glob[$i + 1], ['!', '^'])) { $regex .= '^'; $i++; }
                break;
            case ']': if (!$inClass) return false; $inClass = false; $regex .= ']'; break;
            case '\\': $i++; $regex .= ($i < $len) ? '\\' . preg_quote($glob[$i], '/') : '\\\\'; break;
            default: $regex .= preg_quote($c, '/');
        }
    }
    if ($inClass) return false;
    $base = '/^' . $regex . '$/';
    return $ci ? addCaseInsensitiveFlag($base) : $base;
}
function addCaseInsensitiveFlag(string $r): string {
    if (strlen($r) < 2) return $r;
    $delim = $r[0];
    if ($delim === '\\' || ctype_alnum($delim)) return $r;
    $pos = -1; $len = strlen($r);
    for ($i = 1; $i < $len; $i++) {
        if ($r[$i] === '\\') { $i++; continue; }
        if ($r[$i] === $delim) $pos = $i;
    }
    if ($pos <= 0) return $r;
    $flags = substr($r, $pos + 1);
    if (strpos($flags, 'i') !== false) return $r;
    return substr($r, 0, $pos + 1) . 'i' . $flags;
}

// ── Regex-Normalisierung · R-01 ───────────────────────────────
// Ergaenzt fehlende Delimiter: \.(html|php)$ → /\.(html|php)$/
function normalizeRegex(string $rx): string {
    $rx = trim($rx);
    if ($rx === '') return $rx;
    // Bereits mit Delimiter: /.../ oder #...# etc.
    $first = $rx[0];
    if (!ctype_alnum($first) && $first !== '\\' && $first !== ' ') {
        // Pruefen ob abschliessender Delimiter vorhanden
        $pos = strrpos($rx, $first, 1);
        if ($pos > 0) return $rx; // hat Delimiter
    }
    // Kein Delimiter → /.../ ergaenzen
    return '/' . $rx . '/';
}

// ── File Filtering ────────────────────────────────────────────
$grappa_exts  = ['html', 'htm', 'php', 'json', 'jsontxt', 'md'];
$filteredFiles = $fileInfo;
$patternError  = '';

if ($pattern === '') {
    // Kein Pattern: nur GRAPPA-relevante Extensionen
    $filteredFiles = array_filter($filteredFiles, function ($f) use ($grappa_exts) {
        return in_array($f['ext'], $grappa_exts, true);
    });
} elseif ($useRegex) {
    // R-01: Delimiter auto-ergaenzen, dann validieren
    $normalizedRx = normalizeRegex($pattern);
    $testRx = $filterNoCase ? addCaseInsensitiveFlag($normalizedRx) : $normalizedRx;
    if (@preg_match($testRx, '') === false) {
        $patternError = 'Ungültiger Regex: ' . $pattern
            . ' · Tipp: Glob (Regex ☐): *.html  oder  Regex (☑): \.(html|php)$';
        $filteredFiles = [];
    } else {
        $filteredFiles = array_filter($filteredFiles, function ($f) use ($testRx) {
            return @preg_match($testRx, $f['name']) === 1;
        });
    }
} else {
    // R-02: Glob-Modus · mehrere Patterns per Leerzeichen trennbar
    // z.B. "*.html *.php" matcht beide
    $patterns = array_filter(array_map('trim', explode(' ', $pattern)));
    $filteredFiles = array_filter($filteredFiles, function ($f) use ($patterns, $filterNoCase) {
        foreach ($patterns as $pat) {
            $rx = globToRegex($pat, $filterNoCase);
            if ($rx !== false && preg_match($rx, $f['name']) === 1) return true;
        }
        return false;
    });
}

// ── Grep ─────────────────────────────────────────────────────
$grepResults  = [];
$grepErrors   = [];
$grepError    = '';   // G-02: Fehlermeldung bei ungueltigem Grep-Regex
$totalGrepped = 0;

// G-01: Erkennt /pattern/ oder /pattern/flags als Regex
// Einfacher String ohne Delimiter → String-Suche
function isGrepRegex(string $s): bool {
    $s = trim($s);
    if (strlen($s) < 2) return false;
    if ($s[0] !== '/') return false;
    $close = strrpos($s, '/', 1);
    return $close > 0;
}

if ($grepStr !== '') {
    $grepIsRegex = ($autoGeneratedRegex !== '') || isGrepRegex($grepStr);
    $grepRx      = $grepIsRegex ? $grepStr : '';

    // G-02: Regex vorab validieren
    if ($grepIsRegex && $autoGeneratedRegex === '') {
        if (@preg_match($grepRx, '') === false) {
            $grepError = 'Ungültiger Grep-Regex: ' . $grepStr
                . ' · Tipp: /Hegel/ oder /(Lao|Hegel)/ · String-Suche ohne /-Delimiter';
            $grepIsRegex = false;
            $grepRx      = '';
        }
    }

    foreach ($filteredFiles as $f) {
        $absPath = $currentAbs . DIRECTORY_SEPARATOR . $f['name'];

        if ($grepWholeFile) {
            $content = @file_get_contents($absPath);
            if ($content === false) continue;
            if ($grepIsRegex) {
                $hit = (@preg_match($grepRx, $content) === 1);
            } elseif ($grepNoCase) {
                $hit = stripos($content, $grepStr) !== false;
            } else {
                $hit = strpos($content, $grepStr) !== false;
            }
            if ($hit) {
                $grepResults[$f['name']] = [['line' => 0, 'text' => '(Ganzdatei-Treffer)']];
                $totalGrepped++;
            }
        } else {
            $handle = @fopen($absPath, 'r');
            if (!$handle) continue;
            $lines = []; $ln = 0;
            while (($line = fgets($handle)) !== false) {
                $ln++;
                if ($grepIsRegex) {
                    $hit = (@preg_match($grepRx, $line) === 1);
                } elseif ($grepNoCase) {
                    $hit = stripos($line, $grepStr) !== false;
                } else {
                    $hit = strpos($line, $grepStr) !== false;
                }
                if ($hit) $lines[] = ['line' => $ln, 'text' => rtrim($line)];
            }
            fclose($handle);
            if ($lines) { $grepResults[$f['name']] = $lines; $totalGrepped++; }
        }
    }
}

// ── Sorting ───────────────────────────────────────────────────
$sortedFiles = array_values($filteredFiles);
usort($sortedFiles, function ($a, $b) use ($sort, $dirSort) {
    $cmp = match ($sort) {
        'name'  => strcasecmp($a['name'], $b['name']),
        'ctime' => $a['ctime'] <=> $b['ctime'],
        default => $a['mtime'] <=> $b['mtime'],
    };
    return $dirSort === 'asc' ? $cmp : -$cmp;
});
$totalFiles = count($sortedFiles);

// ── Base Params für URL-Building ──────────────────────────────
$baseParams = [
    'pattern' => $pattern,
    'regex'   => $useRegex ? '1' : '0',
    'fnc'     => $filterNoCase ? '1' : '0',
    'grep'    => ($grepStr === $autoGeneratedRegex) ? '' : $grepStr, // U-03: Auto-Regex nicht in URL
    'gnc'     => $grepNoCase ? '1' : '0',
    'gwf'     => $grepWholeFile ? '1' : '0',
    'keylist' => $keyList,  // U-03: keylist immer in URL sichern
    'subdir'  => $relDisplay,
    'sort'    => $sort,
    'dir'     => $dirSort,
    // U-01: 'action' bewusst NICHT in baseParams -- wird nach Ausfuehrung aus URL entfernt
];

// ── ART-Nr Index aus Dateinamen ───────────────────────────────
// OP-34a: Arbeitsdateien (_v\d{2}\.\d{2}\.) werden NICHT als ART-Keys gewertet
$artNrIndex = [];
foreach ($sortedFiles as $f) {
    if (preg_match('/^(ART-\d{4}-\d{4}-\d{6}\.\d{4})\.json$/', $f['name'], $m)) {
        $artNrIndex[] = $m[1];
    }
}

// ── Index-Generator · OP-34 Ansatz ───────────────────────────
// Vollausbau in v03.02+ auf PO-Anweisung (OP-34)
// Diese Funktion liest alle ART-KEY.json im Verzeichnis
// und baut Grappa_artikel.json (Master-Index)
// OP-34a: Arbeitsdateien mit _vXX.YY im Namen werden ausgeschlossen
function buildIndexGeneratorData(string $dir, int $bakLimit): array {
    $artikelFiles = [];
    $scanItems = @scandir($dir) ?: [];
    foreach ($scanItems as $item) {
        // OP-34a: Arbeitsdateien ausschließen · §17.3 Deploy-Konvention
        if (preg_match('/_v\d{2}\.\d{2}\.(html|php|md|json)$/i', $item)) continue;
        // Nur ART-KEY.json Dateien
        if (!preg_match('/^(ART-\d{4}-\d{4}-\d{6}\.\d{4})\.json$/', $item, $m)) continue;
        $absPath = $dir . DIRECTORY_SEPARATOR . $item;
        $raw = @file_get_contents($absPath);
        if ($raw === false) continue;
        $data = json_decode($raw, true);
        if (!is_array($data)) continue;
        $artikelFiles[] = [
            'art'              => $m[1],
            'datei'            => $item,
            'last_modified'    => $data['last_modified'] ?? '',
            'titel'            => $data['titel'] ?? '',
            'artikel_version'  => $data['artikel_version'] ?? '',
            'framework_version'=> $data['framework_version'] ?? '',
            'status'           => $data['status'] ?? 'aktiv',
            'slug'             => $data['slug'] ?? '',
            'datei_html'       => $data['datei_html'] ?? '',
            'datei_php'        => $data['datei_php'] ?? '',
            'flags'            => $data['flags'] ?? [],
        ];
    }
    // Sortierung nach last_modified aus JSON · §2.9 Architektur-MD
    usort($artikelFiles, fn($a, $b) => strcmp($b['last_modified'], $a['last_modified']));
    return $artikelFiles;
}

function writeGrappaArtikelJson(string $dir, array $artikelData, int $bakLimit): array {
    $outFile = $dir . DIRECTORY_SEPARATOR . 'Grappa_artikel.json';
    $iv = importantValues();
    $payload = [
        'schema'       => 'GRAPPA-Artikel-Register v08.01',
        'generated_by' => 'BRUTALSUCHE_File.php · ' . $iv['artikel_version'],
        'generated_at' => (new DateTimeImmutable('now', new DateTimeZone('UTC')))->format('c'),
        'sort_by'      => 'last_modified',
        'count'        => count($artikelData),
        'objekte'      => $artikelData,
    ];
    if (file_exists($outFile)) {
        rotateBackups($outFile, $bakLimit);
    }
    $written = file_put_contents(
        $outFile,
        json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );
    return [
        'success' => $written !== false,
        'file'    => 'Grappa_artikel.json',
        'count'   => count($artikelData),
    ];
}

// Index-Generator Action
if ($action === 'build_index') {
    $idxData   = buildIndexGeneratorData($currentAbs, $iv['index_generator']['bak_rotation_limit']);
    $actionResult = writeGrappaArtikelJson(
        $currentAbs,
        $idxData,
        $iv['index_generator']['bak_rotation_limit']
    );
    $actionResult['type'] = 'build_index';
}

?>
<!DOCTYPE html>
<!--
  Cpt. Kirk here 🖖
  GGSTC at load: <?= $ggstc_static ?>

  importantValues() → art_nr: <?= $iv['art_nr'] ?> · version: <?= $iv['artikel_version'] ?>
  framework: <?= $iv['framework_version'] ?> · schema: <?= $iv['schema_version'] ?>

  "To boldly go where no framework has gone before."
  — aber das Grappa-Framework fliegt trotzdem. 🥃

  NICHT für: Überwachung · Zensur · Autoritäre Regime
-->
<html lang="<?= htmlspecialchars($iv['sprache']) ?>">
<head>
<link rel="icon" id="grappa-favicon"
      href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🥃</text></svg>">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($iv['titel']) ?></title>
<meta name="author"  content="<?= htmlspecialchars($iv['autor']) ?>">
<meta name="robots"  content="noindex, nofollow">
<meta name="license" content="AGPL-3.0">

<!-- SEO · §22.12 · Werte leer · werden per JS aus IV befüllt · B-02 -->
<meta id="meta-desc" name="description" content="">
<meta id="meta-kw"   name="keywords"    content="">
<meta property="og:type"        content="website">
<meta property="og:title"       content="">
<meta property="og:description" content="">

<style>
  *, *::before, *::after { box-sizing: border-box; }
  body {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    background: #1a1a2e; color: #e0e0e0;
    margin: 0; padding: 12px; font-size: 16px;
    line-height: 1.5;
  }
  .container { max-width: 960px; margin: auto; }

  /* ── GRAPPA BADGE ── */
  .grappa-badge {
    font-family: ui-monospace, 'Courier New', monospace;
    font-size: 0.72rem; color: #e8c87a;
    letter-spacing: 0.15em; text-transform: uppercase;
    margin-bottom: 0.5rem; opacity: 0.8;
  }
  .art-nr { color: #f0ede8; }

  /* ── DRIFT BANNER · §19.8.5 · blinkt ── */
  #grappa-drift-banner {
    display: none;
    background: #8b0000;
    border-bottom: 2px solid #e8242a;
    padding: 0.6rem 1rem;
    font-family: ui-monospace, monospace;
    font-size: 0.78rem; color: #fff;
    margin-bottom: 0.5rem;
    animation: grappa-drift-blink 1.4s step-start infinite;
  }
  @keyframes grappa-drift-blink { 0%,100%{opacity:1} 50%{opacity:0.35} }

  /* ── GGSTC ── */
  .ggstc-bar {
    display: inline-flex; align-items: center; gap: 0.4em;
    font-family: ui-monospace, monospace; font-size: 0.78em;
    margin-left: 12px; vertical-align: middle;
  }
  #ggstc-label { color: #4a9eff; }
  #ggstc-display { color: #f39c12; min-width: 9ch; display: inline-block; }
  #ggstc-mode { font-size: 0.78em; margin-left: 4px; display: none; }
  #ggstc-mode.js-mode { display: inline; color: #ff4444; font-style: italic; }
  #ggstc-mode.py-mode { display: inline; color: #44cc44; font-style: italic; }
  .ggstc-dot { display: inline-block; width: 5px; height: 5px; border-radius: 50%;
               background: #f39c12; animation: ggstc-pulse 10s ease-in-out infinite; }
  @keyframes ggstc-pulse { 0%,100%{opacity:0.4;transform:scale(1)} 50%{opacity:1;transform:scale(1.5)} }

  /* ── VERSION DISPLAY · §26 · blau + unterstrichen ── */
  #version-display {
    font-family: ui-monospace, monospace; font-size: 0.78rem;
    color: #4a9eff; text-decoration: underline;
    cursor: pointer; user-select: none;
    margin-left: 8px; vertical-align: middle;
  }

  /* ── HEADER ── */
  h1 { color: #ff6b6b; margin: 0 0 2px; font-size: 1.4em; display: inline; }
  h4 { color: #aaa; margin: 0 0 10px; font-size: 0.85em; }

  /* ── ACTION RESULT BOX ── */
  .action-box {
    background: #0d2137; border: 1px solid #4a9eff;
    border-radius: 6px; padding: 1rem; margin: 0.75rem 0;
    font-family: ui-monospace, monospace; font-size: 0.85rem;
  }
  .action-box .art-highlight {
    font-size: 1.1rem; color: #e8c87a; font-weight: bold;
    display: block; margin: 0.5rem 0;
  }
  .action-box .po-hinweis {
    color: #ff6b6b; margin-top: 0.5rem; font-size: 0.8rem;
  }
  .action-box.success { border-color: #059669; }
  .action-box.warning { border-color: #f39c12; }

  /* ── FORM ── */
  .search-form {
    background: #16213e; border: 1px solid #333;
    border-radius: 6px; padding: 12px; margin-bottom: 12px;
  }
  .form-row { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 8px; align-items: center; }
  input[type=text], textarea {
    background: #0f3460; color: #e0e0e0; border: 1px solid #444;
    border-radius: 4px; padding: 6px 10px; font-family: ui-monospace, monospace;
    font-size: 0.85rem;
  }
  textarea { resize: vertical; min-height: 60px; width: 100%; }
  input[type=text] { flex: 1; min-width: 120px; }
  button {
    background: #0f3460; color: #e0e0e0; border: 1px solid #444;
    border-radius: 4px; padding: 6px 14px; cursor: pointer;
    font-size: 0.85rem; transition: background 0.2s;
  }
  button:hover { background: #1a4a7a; }
  button.primary { background: #059669; border-color: #047857; }
  button.primary:hover { background: #047857; }
  button.danger  { background: #8b0000; border-color: #600; }
  button.danger:hover { background: #a00; }

  /* ── TOGGLE PILL · BUGFIX v02.06 · ID-Konsistenz ── */
  .pill-wrap { display: inline-flex; align-items: center; gap: 4px; }
  .toggle-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: #0f3460; border: 1px solid #444; border-radius: 20px;
    padding: 4px 12px; cursor: pointer; font-size: 0.82rem;
    transition: background 0.2s, border-color 0.2s; user-select: none;
  }
  .toggle-pill.active { background: #0a5c3a; border-color: #059669; color: #4ade80; }
  .toggle-pill input[type=checkbox] { display: none; }

  /* ── KEY LISTE ── */
  .key-liste-wrap { margin-bottom: 8px; }
  .key-liste-label { font-size: 0.8rem; color: #aaa; margin-bottom: 4px; }

  /* ── RESULTS TABLE ── */
  table { width: 100%; border-collapse: collapse; margin-top: 8px; }
  th, td { text-align: left; padding: 5px 8px; font-size: 0.82rem; border-bottom: 1px solid #2a2a4a; }
  th { background: #16213e; color: #aaa; }
  tr:hover td { background: rgba(74,158,255,0.05); }
  .light-green { color: #90ee90; }
  .dark-green  { color: #3cb371; }
  .th-link { color: #aaa; text-decoration: none; }
  .th-link:hover { color: #4a9eff; }
  .th-link.active { color: #4a9eff; }
  .arrow-active { color: #4a9eff; }

  /* ── GREP RESULTS ── */
  .grep-result { background: #0d2137; border-left: 3px solid #4a9eff; margin: 4px 0; padding: 6px 10px; font-family: ui-monospace, monospace; font-size: 0.78rem; }
  .grep-filename { color: #4a9eff; font-weight: bold; margin-bottom: 4px; }
  .grep-line { color: #aaa; }
  .grep-text { color: #e0e0e0; white-space: pre-wrap; word-break: break-all; }

  /* ── ART-NR INDEX BOX ── */
  .art-index-box {
    background: #0d2137; border: 1px solid #333; border-radius: 4px;
    padding: 8px 12px; margin: 8px 0;
    font-family: ui-monospace, monospace; font-size: 0.78rem;
  }
  .art-index-box .art-item {
    color: #e8c87a; cursor: pointer; display: block; padding: 2px 0;
  }
  .art-index-box .art-item:hover { color: #fff; }
  .art-index-box .art-item-link {
    color: #e8c87a; text-decoration: underline; display: block;
    padding: 2px 0; font-family: ui-monospace, monospace; font-size: 0.78rem;
  }
  .art-index-box .art-item-link:hover { color: #fff; }

  /* ── INDEX GENERATOR BOX ── */
  .index-generator-box {
    background: #16213e; border: 1px solid #4a9eff;
    border-radius: 6px; padding: 1rem; margin: 0.75rem 0;
    font-size: 0.85rem;
  }
  .index-generator-box h3 {
    color: #e8c87a; margin: 0 0 0.6rem; font-size: 1rem;
  }
  .index-generator-box .ig-info {
    color: #888; font-size: 0.78rem; margin-top: 0.5rem;
    font-family: ui-monospace, monospace;
  }
  .index-generator-box .ig-warn {
    color: #f39c12; font-size: 0.78rem; margin-top: 0.4rem;
  }

  /* ── COMPANION LINK ── */
  a.companion-link { color: #4a9eff; text-decoration: underline; }

  /* ── STATS ── */
  .stats { font-size: 0.8rem; color: #aaa; margin: 6px 0; }
  .stats strong { color: #e0e0e0; }

  /* ── CHECK-ART ERGEBNIS · C-01 ── */
  .check-art-box {
    background: #0d2137; border: 1px solid #4a9eff;
    border-radius: 6px; padding: 1rem; margin: 0.75rem 0;
    font-size: 0.83rem;
  }
  .check-art-box h3 { color: #e8c87a; margin: 0 0 0.6rem; font-size: 1rem; }
  .check-art-table { width: 100%; border-collapse: collapse; margin-top: 0.5rem; }
  .check-art-table th {
    background: #16213e; color: #aaa; text-align: left;
    padding: 5px 8px; font-size: 0.78rem; border-bottom: 1px solid #2a2a4a;
  }
  .check-art-table td {
    padding: 5px 8px; font-size: 0.78rem;
    border-bottom: 1px solid #1a1a3a; font-family: ui-monospace, monospace;
    vertical-align: top;
  }
  .check-art-table tr.ca-ok   td { border-left: 3px solid #059669; }
  .check-art-table tr.ca-drift td { border-left: 3px solid #f39c12; background: rgba(243,156,18,0.05); }
  .check-art-table tr.ca-nojson td { border-left: 3px solid #e8242a; background: rgba(232,36,42,0.05); }
  .check-art-table a { color: #4a9eff; text-decoration: underline; }
  .ca-badge {
    display: inline-block; border-radius: 3px; padding: 1px 6px;
    font-size: 0.72rem; font-weight: bold; margin-left: 4px;
  }
  .ca-badge.ok     { background: #059669; color: #fff; }
  .ca-badge.drift  { background: #f39c12; color: #000; }
  .ca-badge.nojson { background: #e8242a; color: #fff; }
  .ca-summary { margin-bottom: 0.6rem; color: #ccc; }
  .ca-summary strong { color: #e8c87a; }

  /* ── PATTERN ERROR · P-04 ── */
  .pattern-error {
    background: #3a0000; border: 1px solid #e8242a;
    border-radius: 5px; padding: 8px 12px; margin-bottom: 8px;
    font-family: ui-monospace, monospace; font-size: 0.8rem; color: #f87171;
  }

  /* ── SCHNELLWAHL · P-02 ── */
  .quick-btns { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 8px; }
  .quick-btn {
    background: #0f3460; border: 1px solid #334; border-radius: 4px;
    color: #90ee90; font-size: 0.75rem; padding: 3px 9px;
    cursor: pointer; font-family: ui-monospace, monospace;
    transition: background 0.15s;
  }
  .quick-btn:hover { background: #1a4a7a; border-color: #4a9eff; color: #fff; }

  /* ── LS INFO ── */
  #ls-info { font-size: 0.75rem; color: #666; margin-left: 8px; }

  /* ── FOOTER ── */
  .site-footer {
    border-top: 1px solid rgba(232,200,122,0.15);
    margin-top: 2rem; padding-top: 1rem;
    font-family: ui-monospace, monospace;
    font-size: 0.7rem; color: #555; line-height: 2;
  }

  /* ── RWD · BUGFIX v02.06 ── */
  @media (max-width: 600px) {
    body { padding: 8px; font-size: 14px; }
    .form-row { flex-direction: column; }
    input[type=text] { width: 100%; }
    table { font-size: 0.75rem; }
    th, td { padding: 4px 5px; }
  }
  @media (max-width: 400px) {
    h1 { font-size: 1.1em; }
    .ggstc-bar { display: none; }
  }
</style>
</head>
<body>
<div class="container">

<!-- ── DRIFT BANNER · §19.8.5 · blinkt ── -->
<div id="grappa-drift-banner" role="alert" aria-live="assertive">
  <strong style="color:#ffaaaa;">⚠ GRAPPA DRIFT DETECTED</strong><br>
  <span id="grappa-drift-details">…</span>
</div>

<!-- ── HEADER ── -->
<div class="grappa-badge" id="grappa-badge">
  🥃 GRAPPA FREE FRAMEWORK · <?= htmlspecialchars($iv['framework_version']) ?> · <span class="art-nr"><?= htmlspecialchars($iv['art_nr']) ?></span>
</div>
<div style="margin-bottom:6px;">
  <h1>🔍 BRUTALSUCHE_File</h1>
  <span class="ggstc-bar">
    <span class="ggstc-dot"></span>
    <span id="ggstc-label">GGSTC</span>
    <span id="ggstc-display"><?= $ggstc_static ?></span>
    <span id="ggstc-mode" class="js-mode">⚠ JS</span>
    <span class="ggstc-dot"></span>
  </span>
  <span id="version-display" title="3× klicken für eruda Debug-Konsole (§26)" role="button" tabindex="0">
    <?= htmlspecialchars($iv['framework_version']) ?> · <?= htmlspecialchars($iv['artikel_version']) ?>
  </span>
</div>
<h4>
  <?= htmlspecialchars($iv['schema_version']) ?> · <?= htmlspecialchars($relDisplay) ?> ·
  Companion: <a class="companion-link" href="JSON_SmartFilter.php">JSON_SmartFilter.php</a>
</h4>

<?php if ($actionResult): ?>
<!-- ── ACTION RESULT ── -->
<div class="action-box <?= isset($actionResult['success']) && $actionResult['success'] ? 'success' : '' ?>">
  <?php if (isset($actionResult['new_art_nr'])): ?>
    <strong>🆕 Neue ART-Nr generiert:</strong>
    <span class="art-highlight"><?= htmlspecialchars($actionResult['new_art_nr']) ?></span>
    <div class="po-hinweis">
      ⚠ PO-Aktion erforderlich:<br>
      1. Diese ART-Nr kopieren<br>
      2. In importantValues() · Feld 'art_nr' · hardcoded eintragen<br>
      3. Datei speichern · per FTP deployen<br>
      → Erst dann ist der Artikel registriert · §6.2 Architektur-MD
    </div>
  <?php elseif (isset($actionResult['vorschlag'])): ?>
    <strong>📁 Dateiname-Vorschlag:</strong>
    <span class="art-highlight"><?= htmlspecialchars($actionResult['vorschlag']) ?></span>
    <div class="po-hinweis">
      ⚠ PO prüft ob dieser Name auf dem Host existiert (FTP oder Browser).<br>
      Wenn frei: Dummy-Datei anlegen → Name sperren → OK melden → ART-Nr generieren.<br>
      → §6.2 Dateiname-Sperrprotokoll
    </div>
  <?php elseif (isset($actionResult['type']) && $actionResult['type'] === 'build_index'): ?>
    <strong><?= $actionResult['success'] ? '✅ Index-Generator: Grappa_artikel.json erzeugt' : '❌ Fehler beim Schreiben' ?></strong><br>
    <?php if ($actionResult['success']): ?>
      Datei: <span class="art-highlight">Grappa_artikel.json</span>
      <?= $actionResult['count'] ?> ART-Keys indexiert · sortiert nach last_modified aus JSON<br>
      <span style="color:#aaa; font-size:0.78rem;">
        OP-34a: Arbeitsdateien (_vXX.YY.*) wurden ausgeschlossen · §17.3 Deploy-Konvention<br>
        BAK-Rotation: <?= $iv['index_generator']['bak_rotation_limit'] ?> Versionen
      </span>
    <?php endif; ?>
  <?php elseif (isset($actionResult['success'])): ?>
    <strong><?= $actionResult['success'] ? '✅ buildGrappaArtifact() erfolgreich' : '❌ Fehler beim Schreiben' ?></strong><br>
    JSON: <span class="art-highlight"><?= htmlspecialchars($actionResult['json_file']) ?></span>
    Version: <?= htmlspecialchars($actionResult['version']) ?>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php if ($action !== '' && $action !== 'check_art'): ?>
<!-- Suchform wird nach non-check_art-Action weiterhin angezeigt -->
<?php endif; ?>

<?php if ($checkArtResults !== null): ?>
<!-- ── CHECK-ART ERGEBNIS · C-01 ── -->
<?php
$ca_ok     = array_filter($checkArtResults, fn($r) => $r['klasse'] === 'ok');
$ca_drift  = array_filter($checkArtResults, fn($r) => $r['klasse'] === 'drift');
$ca_nojson = array_filter($checkArtResults, fn($r) => $r['klasse'] === 'no_json');
$relUrl    = rtrim($relDisplay, '/') . '/';
?>
<div class="check-art-box">
  <h3>🔬 ART-Konsistenzprüfung · check_art
    <span style="font-size:0.75rem; color:#aaa;">· <?= htmlspecialchars($relDisplay) ?></span>
  </h3>
  <div class="ca-summary">
    Geprüft: <strong><?= count($checkArtResults) ?></strong> Dateien ·
    <span style="color:#059669;">✅ OK: <?= count($ca_ok) ?></span> ·
    <span style="color:#f39c12;">⚠ Drift: <?= count($ca_drift) ?></span> ·
    <span style="color:#e8242a;">❌ JSON fehlt: <?= count($ca_nojson) ?></span>
    <br><small style="color:#666;">Nur höchste Version je Basisname · Arbeitsdateien _vXX.YY werden korrekt verglichen · C-02</small>
  </div>

  <?php if (count($checkArtResults) === 0): ?>
    <p style="color:#aaa;">Keine GRAPPA-konformen HTML/PHP-Dateien (mit art_nr) gefunden.</p>
  <?php else: ?>
  <table class="check-art-table">
    <thead>
      <tr>
        <th>Datei (Link)</th>
        <th>art_nr aus IV</th>
        <th>JSON-Datei (Link)</th>
        <th>art in JSON</th>
        <th>Version JSON</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($checkArtResults as $r):
        $rowClass = match($r['klasse']) {
            'ok'      => 'ca-ok',
            'drift'   => 'ca-drift',
            'no_json' => 'ca-nojson',
            default   => ''
        };
        $badge = match($r['klasse']) {
            'ok'      => '<span class="ca-badge ok">✅ OK</span>',
            'drift'   => '<span class="ca-badge drift">⚠ DRIFT</span>',
            'no_json' => '<span class="ca-badge nojson">❌ kein JSON</span>',
            default   => ''
        };
        $fileUrl = $relUrl . rawurlencode($r['datei']);
        $sfJsonUrl = 'GRAPPABRUTAL_JSON_SmartFilter_Editor.php?JsonPfadName=' . rawurlencode('./' . $r['json_datei']);
    ?>
      <tr class="<?= $rowClass ?>">
        <td><a href="<?= htmlspecialchars($fileUrl) ?>" target="_blank"><?= htmlspecialchars($r['datei']) ?></a></td>
        <td><?= htmlspecialchars($r['art_nr_iv']) ?></td>
        <td>
          <?php if ($r['json_exists']): ?>
            <a href="<?= htmlspecialchars($sfJsonUrl) ?>" title="Im SmartFilter Editor öffnen"><?= htmlspecialchars($r['json_datei']) ?></a>
          <?php else: ?>
            <span style="color:#666;"><?= htmlspecialchars($r['json_datei']) ?></span>
            <span style="color:#e8242a; font-size:0.7rem;"> nicht vorhanden</span>
          <?php endif; ?>
        </td>
        <td><?= $r['json_art'] !== null ? htmlspecialchars($r['json_art']) : '<span style="color:#666;">—</span>' ?></td>
        <td><?= $r['json_version'] !== null ? htmlspecialchars($r['json_version']) : '<span style="color:#666;">—</span>' ?></td>
        <td><?= $badge ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <?php if (count($ca_drift) > 0): ?>
  <div style="margin-top:0.8rem; padding:0.6rem; background:rgba(243,156,18,0.08); border-radius:4px; font-size:0.78rem; color:#f39c12;">
    <strong>⚠ DRIFT-Fälle:</strong> art_nr aus IV stimmt nicht mit art/key aus JSON überein.
    JSON muss korrigiert werden (art gewinnt · §34.5). Nächste Aktion: JSON per buildGrappaArtifact() neu erzeugen oder manuell patchen.
  </div>
  <?php endif; ?>

  <?php if (count($ca_nojson) > 0): ?>
  <div style="margin-top:0.5rem; padding:0.6rem; background:rgba(232,36,42,0.08); border-radius:4px; font-size:0.78rem; color:#e8242a;">
    <strong>❌ JSON fehlt:</strong> Diese Dateien haben art_nr in IV aber keine zugehörige JSON-Schaltzentrale.
    Nächste Aktion: buildGrappaArtifact() aufrufen · §33.
  </div>
  <?php endif; ?>
  <?php endif; ?>
</div>
<?php endif; ?>

<!-- ── SEARCH FORM ── -->
<form class="search-form" method="get" id="mainform">
  <input type="hidden" name="subdir" value="<?= htmlspecialchars($relDisplay) ?>">

  <?php if ($patternError): ?>
  <div class="pattern-error">⚠ <?= htmlspecialchars($patternError) ?></div>
  <?php endif; ?>

  <!-- P-02: Schnellwahl Dateiname -->
  <div class="quick-btns">
    <span style="font-size:0.72rem; color:#666; align-self:center;">Schnell:</span>
    <button type="button" class="quick-btn" onclick="setPattern('*.html',false)">*.html</button>
    <button type="button" class="quick-btn" onclick="setPattern('*.php',false)">*.php</button>
    <button type="button" class="quick-btn" onclick="setPattern('*.json',false)">*.json</button>
    <button type="button" class="quick-btn" onclick="setPattern('*.html *.php',false)">html+php</button>
    <button type="button" class="quick-btn" onclick="setPattern('*.html *.php *.json',false)">html+php+json</button>
    <button type="button" class="quick-btn" onclick="setPattern('',false)">alle GRAPPA</button>
  </div>

  <div class="form-row">
    <input type="text" name="pattern" id="patternInput" value="<?= htmlspecialchars($pattern) ?>"
           placeholder="Glob: *.html  ·  Regex ☑: \.(html|php)$" style="flex:2">
    <label class="toggle-pill <?= $useRegex ? 'active' : '' ?>" id="pill-regex">
      <input type="checkbox" name="regex" id="regex" value="1" <?= $useRegex ? 'checked' : '' ?>>
      ⚡ Regex
    </label>
    <label class="toggle-pill <?= $filterNoCase ? 'active' : '' ?>" id="pill-fnc">
      <input type="checkbox" name="fnc" id="fnc" value="1" <?= $filterNoCase ? 'checked' : '' ?>>
      Aa ignore
    </label>
  </div>

  <div class="form-row">
    <input type="text" name="grep" id="grepInput" value="<?= htmlspecialchars($grepStr === $autoGeneratedRegex ? '' : $grepStr) ?>"
           placeholder="Text: Hegel  ·  Regex: /Hegel/  ·  Oder: /(Lao|Hegel)/" style="flex:2">
    <label class="toggle-pill <?= $grepNoCase ? 'active' : '' ?>" id="pill-gnc">
      <input type="checkbox" name="gnc" id="gnc" value="1" <?= $grepNoCase ? 'checked' : '' ?>>
      Aa ignore
    </label>
    <label class="toggle-pill <?= $grepWholeFile ? 'active' : '' ?>" id="pill-gwf">
      <input type="checkbox" name="gwf" id="gwf" value="1" <?= $grepWholeFile ? 'checked' : '' ?>>
      Ganzdatei
    </label>
  </div>

  <?php if ($grepError): ?>
  <div class="pattern-error">⚠ <?= htmlspecialchars($grepError) ?></div>
  <?php endif; ?>

  <div class="key-liste-wrap">
    <div class="key-liste-label">Key-Liste (ein Key pro Zeile → Auto-Regex):</div>
    <textarea name="keylist" id="keyListInput" rows="3"
              placeholder="datei_json&#10;artikel_version&#10;relatedTo"><?= htmlspecialchars($keyList) ?></textarea>
  </div>

  <div class="form-row">
    <button type="submit" class="primary">🔍 Suchen</button>
    <button type="button" onclick="lsSave()">💾 Speichern</button>
    <button type="button" onclick="lsLoad()">📂 Laden</button>
    <button type="button" onclick="lsDel()" class="danger">🗑 Löschen</button>
    <span id="ls-info"></span>
  </div>
</form>

<!-- ── ART-NR INDEX ── -->
<?php if (count($artNrIndex) > 0): ?>
<div class="art-index-box">
  <strong style="color:#e8c87a;">📋 ART-Nr Index (<?= count($artNrIndex) ?> gefunden):</strong>
  <div style="font-size:0.7rem; color:#666; margin:2px 0 6px;">Klick → JSON_SmartFilter Editor</div>
  <?php foreach ($artNrIndex as $artNr):
    // SmartFilter-URL: JsonPfadName=./ART-xxx.json · Fallback Filepicker wenn kein Parameter
    $sfUrl = 'GRAPPABRUTAL_JSON_SmartFilter_Editor.php?JsonPfadName=./' . rawurlencode($artNr . '.json');
  ?>
    <a class="art-item-link" href="<?= htmlspecialchars($sfUrl) ?>"
       title="JSON_SmartFilter: <?= htmlspecialchars($artNr) ?>.json">
      <?= htmlspecialchars($artNr) ?>
    </a>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- ── DIRECTORY NAVIGATION ── -->
<div class="stats">
  📁 <strong><?= htmlspecialchars($relDisplay) ?></strong>
  <?php if ($hasParent): ?>
    · <a href="<?= htmlspecialchars(buildUrl(array_merge($baseParams, ['subdir' => './' . ltrim(str_replace($docRoot, '', $parentAbs), DIRECTORY_SEPARATOR)]))) ?>"
         style="color:#4a9eff;">↑ Übergeordnet</a>
  <?php endif; ?>
</div>

<?php if (count($subdirs) > 0): ?>
<div class="stats">
  <?php foreach ($subdirs as $sd): ?>
    <a href="<?= htmlspecialchars(buildUrl(array_merge($baseParams, ['subdir' => rtrim($relDisplay, '/') . '/' . $sd]))) ?>"
       style="color:#90ee90; margin-right:12px;">📁 <?= htmlspecialchars($sd) ?></a>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- ── FILE TABLE ── -->
<div class="stats">
  <strong><?= $totalFiles ?></strong> Dateien
  <?php if ($grepStr !== ''): ?>
    · Grep-Treffer: <strong><?= $totalGrepped ?></strong>
    <?php if ($autoGeneratedRegex): ?>
      · Auto-Regex aus Key-Liste aktiv
    <?php endif; ?>
  <?php endif; ?>
</div>

<table>
  <thead>
    <tr>
      <th><?= headerLink('Dateiname', 'name', $sort, $dirSort, $baseParams) ?></th>
      <th><?= headerLink('Geändert', 'mtime', $sort, $dirSort, $baseParams) ?></th>
      <th><?= headerLink('Erstellt', 'ctime', $sort, $dirSort, $baseParams) ?></th>
      <th>Ext</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sortedFiles as $f): ?>
    <tr>
      <td>
        <?php
          $fileOpenUrl = rtrim($relDisplay, '/') . '/' . rawurlencode($f['name']);
        ?>
        <span class="<?= colorClass($f['ext']) ?>"
              onclick="openFile('<?= htmlspecialchars(addslashes($fileOpenUrl)) ?>','<?= htmlspecialchars(addslashes($f['name'])) ?>')"
              style="cursor:pointer;" title="Datei öffnen (Klick)">
          <?= htmlspecialchars($f['name']) ?>
        </span>
        <?php if (isset($grepResults[$f['name']])): ?>
          <span style="color:#f39c12; font-size:0.75rem; margin-left:6px;">
            (<?= count($grepResults[$f['name']]) ?> Treffer)
          </span>
        <?php endif; ?>
      </td>
      <td style="font-family:ui-monospace,monospace; font-size:0.75rem; color:#888;">
        <?= date('Y-m-d H:i', $f['mtime']) ?>
      </td>
      <td style="font-family:ui-monospace,monospace; font-size:0.75rem; color:#888;">
        <?= ($f['ctime'] === PHP_INT_MAX) ? '—' : date('Y-m-d H:i', $f['ctime']) ?>
      </td>
      <td style="font-family:ui-monospace,monospace; font-size:0.75rem; color:#666;">
        <?= htmlspecialchars($f['ext']) ?>
      </td>
    </tr>
    <?php if (isset($grepResults[$f['name']])): ?>
    <tr>
      <td colspan="4">
        <div class="grep-result">
          <div class="grep-filename"><?= htmlspecialchars($f['name']) ?></div>
          <?php foreach ($grepResults[$f['name']] as $gl): ?>
            <div>
              <?php if ($gl['line'] > 0): ?>
                <span class="grep-line">L<?= $gl['line'] ?>:</span>
              <?php endif; ?>
              <span class="grep-text"><?= htmlspecialchars($gl['text']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </td>
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- ── INDEX GENERATOR · OP-34 Ansatz ── -->
<div class="index-generator-box">
  <h3>⚙ Index-Generator
    <span style="font-size:0.75rem; color:#4a9eff;">· OP-34 · Ansatz implementiert</span>
  </h3>
  <p style="color:#ccc; margin:0 0 0.6rem;">
    Liest alle <code>ART-KEY.json</code> im aktuellen Verzeichnis →
    erzeugt <code>Grappa_artikel.json</code> (Master-Index) →
    sortiert nach <code>last_modified</code> aus JSON (§6.1).<br>
    BAK-Rotation: <?= $iv['index_generator']['bak_rotation_limit'] ?> Versionen.
  </p>
  <div class="form-row">
    <a href="?action=build_index&subdir=<?= urlencode($relDisplay) ?>"
       style="display:inline-block;">
      <button type="button" class="primary">📋 Grappa_artikel.json erzeugen</button>
    </a>
    <a href="?action=check_art&subdir=<?= urlencode($relDisplay) ?>"
       style="display:inline-block;">
      <button type="button" class="primary">🔬 ART-Konsistenz prüfen</button>
    </a>
    <a href="?action=build_artifact" style="display:inline-block;">
      <button type="button">🔧 buildGrappaArtifact()</button>
    </a>
    <a href="?action=generate_art_nr" style="display:inline-block;">
      <button type="button">🆕 Neue ART-Nr generieren</button>
    </a>
    <a href="?action=slug_vorschlag&titel=Mein+Artikel&ext=html" style="display:inline-block;">
      <button type="button">📁 Slug-Vorschlag testen</button>
    </a>
  </div>
  <div class="ig-info">
    OP-34a: Arbeitsdateien (<code>_vXX.YY.*</code>) werden automatisch ausgeschlossen · §17.3<br>
    Vollausbau (OP-34): grappa_index.php UI · Filter · Export · Konsistenz-Check · fw v08.01
  </div>
  <div class="ig-warn">
    ⚠ embedArtNrInPhp() deaktiviert · Self-Modification auf Infinity Free unklar · PO-Entscheid ausstehend
  </div>
</div>

<!-- ── FOOTER ── -->
<footer class="site-footer">
  <p>🥃 GRAPPA FREE FRAMEWORK · <span id="footer-fw-ver"><?= htmlspecialchars($iv['framework_version']) ?></span> · AGPL-3.0</p>
  <p>
    Version: <span id="footer-art-ver"><?= htmlspecialchars($iv['artikel_version']) ?></span> ·
    Artikel: <span id="footer-art"><?= htmlspecialchars($iv['art_nr']) ?></span> ·
    Autor: <?= htmlspecialchars($iv['autor']) ?>
  </p>
  <p>
    Schema: <?= htmlspecialchars($iv['schema_version']) ?> ·
    Rüsselsheim am Main · Wolf · vivo X300 Pro
  </p>
  <p style="margin-top:0.3rem; color:#444;">
    🖖 „To boldly go where no framework has gone before." — USS GRAPPA NCC-rcpffm-claude
  </p>
</footer>

</div><!-- /.container -->

<script>
// ── GGSTC JS-Fallback · Zero External beim Seitenaufruf ─────
(function() {
    function calcGgstc() {
        var now = new Date(), year = now.getUTCFullYear();
        var start = Date.UTC(year, 0, 1);
        var doy = Math.floor((Date.UTC(year, now.getUTCMonth(), now.getUTCDate()) - start) / 86400000) + 1;
        var isLeap = (year % 4 === 0 && (year % 100 !== 0 || year % 400 === 0));
        var sec = now.getUTCHours() * 3600 + now.getUTCMinutes() * 60 + now.getUTCSeconds();
        return ((year - 2323) * 1000 + (doy / (isLeap ? 366 : 365)) * 1000 + (sec / 86400)).toFixed(4);
    }
    function setMode(m) {
        var el = document.getElementById('ggstc-mode');
        if (!el) return;
        el.textContent = m === 'py' ? '🖖 Py' : '⚠ JS';
        el.className = m === 'py' ? 'py-mode' : 'js-mode';
    }
    function upd() {
        var el = document.getElementById('ggstc-display');
        if (el) el.textContent = calcGgstc();
    }
    upd(); setMode('js');
    var ji = setInterval(upd, 10000);
    var att = 0;
    var wi = setInterval(function() {
        att++;
        if (typeof window.ggstc_update === 'function') {
            clearInterval(wi); clearInterval(ji); setMode('py');
            setInterval(function() { try { window.ggstc_update(); } catch(e) {} }, 10000);
        } else if (att >= 60) clearInterval(wi);
    }, 500);
})();

// ── eruda · 3× Klick auf #version-display · §26 ──────────────
(function() {
    var c = 0, t = null;
    document.addEventListener('DOMContentLoaded', function() {
        var v = document.getElementById('version-display');
        if (!v) return;
        v.addEventListener('click', function() {
            c++; if (t) clearTimeout(t);
            t = setTimeout(function() { c = 0; }, 900);
            if (c >= 3) {
                c = 0;
                if (typeof eruda !== 'undefined') { eruda.init(); eruda.show(); }
                else {
                    var s = document.createElement('script');
                    s.src = 'https://cdn.jsdelivr.net/npm/eruda';
                    s.onload = function() { eruda.init(); eruda.show(); };
                    document.head.appendChild(s);
                }
            }
        });
    });
})();

// ── validateImportantValues() · §22.8 · B-04 ─────────────────
// §34.5 Übergangsregel: IV hat 'art_nr' · JSON hat 'art' + 'key' · beide identisch
(function() {
    var _artNr  = '<?= addslashes($iv['art_nr']) ?>';
    var _artVer = '<?= addslashes($iv['artikel_version']) ?>';
    var _fwVer  = '<?= addslashes($iv['framework_version']) ?>';
    var _datPHP = '<?= addslashes($iv['datei_php']) ?>';
    var _desc   = '<?= addslashes($iv['beschreibung']) ?>';
    var _kw     = '<?= addslashes($iv['keywords']) ?>';

    fetch('./' + _artNr + '.json')
        .then(function(r) {
            if (!r.ok) throw new Error('HTTP ' + r.status);
            return r.json();
        })
        .then(function(data) {
            // §34.5: json['art'] entspricht iv['art_nr'] · B-05
            var checks = [
                ['art_nr → art',      String(data['art']               || ''), _artNr ],
                ['artikel_version',   String(data['artikel_version']   || ''), _artVer],
                ['framework_version', String(data['framework_version'] || ''), _fwVer ],
                ['datei_php',         String(data['datei_php']         || ''), _datPHP],
                ['beschreibung',      String(data['beschreibung']      || ''), _desc  ],
                ['keywords',          String(data['keywords']          || ''), _kw    ],
            ];
            var drifts = [];
            checks.forEach(function(c) {
                if (c[1] !== c[2])
                    drifts.push(c[0] + ': IV=' + JSON.stringify(c[2])
                        + ' ≠ JSON=' + JSON.stringify(c[1]));
            });
            if (drifts.length > 0) {
                var b = document.getElementById('grappa-drift-banner');
                var d = document.getElementById('grappa-drift-details');
                if (b && d) { d.textContent = drifts.join(' · '); b.style.display = 'block'; }
                console.error('⚠ GRAPPA DRIFT:', drifts);
            } else {
                console.log('✅ GRAPPA validateImportantValues: OK · ' + _artNr + ' · ' + _artVer);
            }
        })
        .catch(function(e) {
            console.log('GRAPPA validate: JSON nicht erreichbar (' + e.message + ')');
        });
})();

// ── SEO DOM-Patches · §22.12 · B-02/B-06 ────────────────────
document.addEventListener('DOMContentLoaded', function() {
    var md = document.getElementById('meta-desc');
    if (md) md.content = '<?= addslashes($iv['beschreibung']) ?>';

    var mk = document.getElementById('meta-kw');
    if (mk) mk.content = '<?= addslashes($iv['keywords']) ?>';

    var ogt = document.querySelector('meta[property="og:title"]');
    if (ogt) ogt.content = '<?= addslashes($iv['og_titel']) ?>';

    var ogd = document.querySelector('meta[property="og:description"]');
    if (ogd) ogd.content = '<?= addslashes($iv['og_beschreibung']) ?>';
    // og_image: kein Grappa-Objekt vorhanden · §22.12 · optional
});

// ── Toggle Pills · BUGFIX v02.06 · ID-Konsistenz ─────────────

document.addEventListener('DOMContentLoaded', function() {
    syncPill('fnc', 'pill-fnc');
    syncPill('gnc', 'pill-gnc');
    syncPill('gwf', 'pill-gwf');
    syncPill('regex', 'pill-regex');
});
function syncPill(cbId) {
    var cb   = document.getElementById(cbId);
    var pill = document.getElementById('pill-' + cbId);
    if (!cb || !pill) return;

    // Initialzustand setzen
    cb.checked ? pill.classList.add('active') 
               : pill.classList.remove('active');

    // NUR auf Checkbox hören · kein eigener Pill-Listener
    cb.addEventListener('change', function() {
        cb.checked ? pill.classList.add('active')
                   : pill.classList.remove('active');
    });
}
// ── setPattern() · Schnellwahl · P-02 ────────────────────────
function setPattern(val, isRegex) {
    var p = document.getElementById('patternInput');
    if (p) p.value = val;
    var cb = document.getElementById('regex');
    if (cb) {
        cb.checked = isRegex;
        syncPill('regex');
    }
}

// ── openFile() · Datei oeffnen · F-01 ────────────────────────
// Speichert Suche in LS + URL, oeffnet Datei nach Bestaetigung
function openFile(url, name) {
    // Suche zuerst sichern
    var s = lsGetState();
    try { localStorage.setItem(LS_KEY, JSON.stringify(s)); } catch(e) {}
    // URL aktuell halten
    if (window.history && window.history.replaceState) {
        var cur = new URL(window.location.href);
        // Leere Parameter entfernen
        var toDel = [];
        cur.searchParams.forEach(function(v,k){ if(!v) toDel.push(k); });
        toDel.forEach(function(k){ cur.searchParams.delete(k); });
        window.history.replaceState({}, '', cur.toString());
    }
    if (confirm('Datei öffnen?\n' + name)) {
        window.open(url, '_blank');
    }
}

// ── setGrep() · HTML-Entity-safe ─────────────────────────────
function setGrep(val) {
    var el = document.getElementById('grepInput');
    if (el) {
        var ta = document.createElement('textarea');
        ta.innerHTML = val;
        el.value = ta.value;
        var kl = document.getElementById('keyListInput');
        if (kl) kl.value = '';
    }
}

// ── LocalStorage · Zustand speichern/laden ───────────────────
var LS_KEY = 'brutalsuche_v0305'; // R-04: versioniert je Major

function lsGetState() {
    return {
        pattern: (document.getElementById('patternInput') || {}).value || '',
        grep:    (document.getElementById('grepInput') || {}).value || '',
        keylist: (document.getElementById('keyListInput') || {}).value || '',
        regex: !!(document.getElementById('regex') || {}).checked,
        gwf:   !!(document.getElementById('gwf')   || {}).checked,
        gnc:   !!(document.getElementById('gnc')   || {}).checked,
        fnc:   !!(document.getElementById('fnc')   || {}).checked,
        ts:    new Date().toISOString()
    };
}
function lsSave() {
    var s = lsGetState();
    try {
        localStorage.setItem(LS_KEY, JSON.stringify(s));
        var el = document.getElementById('ls-info');
        if (el) el.textContent = '💾 ' + s.ts.substr(0, 19).replace('T', ' ');
    } catch(e) { alert('Speichern fehlgeschlagen: ' + e.message); }
}
function lsLoad() {
    var raw = localStorage.getItem(LS_KEY);
    if (!raw) { alert('Kein gespeicherter Zustand.'); return; }
    try {
        var s = JSON.parse(raw);
        var p = document.querySelector('input[name=pattern]');
        if (p) p.value = s.pattern || '';
        var g = document.getElementById('grepInput');
        if (g) g.value = s.grep || '';
        var k = document.getElementById('keyListInput');
        if (k) k.value = s.keylist || '';
        var gwf = document.getElementById('gwf');
        if (gwf) gwf.checked = !!s.gwf;
        var gnc = document.getElementById('gnc');
        if (gnc) gnc.checked = !!s.gnc;
        var fnc = document.getElementById('fnc');
        if (fnc) fnc.checked = s.fnc !== false;
        syncPill('fnc', 'pill-fnc');
        syncPill('gnc', 'pill-gnc');
        syncPill('gwf', 'pill-gwf');
        document.getElementById('mainform').submit();
    } catch(e) { alert('Laden fehlgeschlagen: ' + e.message); }
}
function lsDel() {
    if (confirm('Gespeicherten Zustand löschen?')) {
        try {
            localStorage.removeItem(LS_KEY);
            var el = document.getElementById('ls-info');
            if (el) el.textContent = '— gelöscht —';
        } catch(e) { alert('Löschen fehlgeschlagen: ' + e.message); }
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var el = document.getElementById('ls-info');
    try {
        var raw = localStorage.getItem(LS_KEY);
        if (el && raw) {
            var s = JSON.parse(raw);
            el.textContent = '💾 ' + (s.ts ? s.ts.substr(0, 19).replace('T', ' ') : '?');
        }
    } catch(e) {}
});

// ── Audio Klacker · §12.3 ────────────────────────────────────
<?php if ($totalFiles > 0): ?>
try {
    var AudioCtx = window.AudioContext || window.webkitAudioContext;
    if (AudioCtx) {
        var ctx = new AudioCtx();
        var now = ctx.currentTime;
        for (var i = 0; i < 5; i++) {
            var osc = ctx.createOscillator();
            var gain = ctx.createGain();
            osc.frequency.value = 600 + i * 150;
            gain.gain.setValueAtTime(0.08, now + i * 0.08);
            gain.gain.exponentialRampToValueAtTime(0.001, now + i * 0.08 + 0.06);
            osc.connect(gain); gain.connect(ctx.destination);
            osc.start(now + i * 0.08); osc.stop(now + i * 0.08 + 0.06);
        }
    }
} catch(e) {}
<?php endif; ?>

// ── URL History bereinigen · U-01: action nach Ausfuehrung entfernen ──
if (window.history && window.history.replaceState) {
    var url = new URL(window.location.href);
    // Leere Parameter entfernen
    var toDelete = [];
    url.searchParams.forEach(function(value, key) {
        if (!value || value === '') toDelete.push(key);
    });
    toDelete.forEach(function(k) { url.searchParams.delete(k); });
    // U-01: action-Parameter entfernen -- wurde serverseitig ausgefuehrt,
    // soll nicht bei URL-Kopie erneut ausgefuehrt werden
    url.searchParams.delete('action');
    window.history.replaceState({}, '', url.toString());
}

// ── §25 QS-04 · console.log aus IV ───────────────────────────
console.log('GRAPPA · <?= addslashes($iv['datei_php']) ?> · <?= addslashes($iv['artikel_version']) ?> · <?= addslashes($iv['framework_version']) ?> · <?= addslashes($iv['art_nr']) ?>');

</script>

<!-- PyScript · Plan A · on-demand · §26.3 · kein Load beim normalen Seitenaufruf
     Wird geladen wenn PO explizit aktiviert (zukünftige Erweiterung)
     JS-Fallback (oben) ist aktiv solange PyScript nicht geladen
<script type="py">
from datetime import datetime, timezone
from pyscript import document
import js

def calc_ggstc(now_utc):
    year = now_utc.year
    doy  = now_utc.timetuple().tm_yday
    diy  = 366 if (year % 4 == 0 and (year % 100 != 0 or year % 400 == 0)) else 365
    sec  = now_utc.hour * 3600 + now_utc.minute * 60 + now_utc.second
    return round((year - 2323) * 1000 + (doy / diy) * 1000 + (sec / 86400), 4)

def update(*args):
    try:
        val = calc_ggstc(datetime.now(timezone.utc))
        el = document.getElementById("ggstc-display")
        if el: el.textContent = f"{val:.4f}"
        mode = document.getElementById("ggstc-mode")
        if mode:
            mode.textContent = "🖖 Py"
            mode.className = "py-mode"
    except Exception as e:
        js.console.error(f"GGSTC update failed: {e}")

update()
js.window.ggstc_update = update
</script>
-->

</body>
</html>
