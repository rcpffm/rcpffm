<?php
// ============================================================
//  GRAPPABRUTAL_JSON_SmartFilter_Editor.php  v04.00
//  (c) rcpffm – AGPL-3.0  ❤️❤️ 
//  https://www.gnu.org/licenses/agpl-3.0.html
//
//  Part of GRAPPA FREE FRAMEWORK
//  https://github.com/rcpffm
//
//  RESILIENCE BY DESIGN – No Single Point of Failure
//  Designed for distributed, censorship-resistant deployment.
//
//  NEU v04.00 (GRAPPA fw v08.00 Retrofit):
//    + importantValues() vollstaendig · §22 · art_nr · framework_version · SEO
//    + validateImportantValues() · Drift-Banner · §22.8
//    + eruda 3x-Klick auf #version-display · §26
//    + Zweisprachigkeit DE/EN · Flaggen-Toggle · §27
//    + URL-Parameter JsonPfadName= (war wasist=) · BRUTALSUCHE-Schnittstelle
//    + Pfad-Pruefung: ./ unterstellt · Existenz-Check · Filepicker-Fallback *.json
//    + Zuletzt bearbeitete JSON via replaceState in URL · U-01
//    + system-ui Fonts · #degoogle · §8.5b
//    + TAG-Block · Kirk-Kommentar · AGPL-Header
//    + Dateiliste: *.json aus ./ · jsonbak separat ausklappbar
//
//  Vorgaenger: v03.60 (rcpffm + Gemini)
//
//  #TAG:GRAPPA-STD #AUTHOR:rcpffm #UTC:2026-03-28T09:00:00Z
//  #VER:v04.00 #GRAPPA:fw v08.00 #LICENSE:AGPL-3.0
//  #ENCODING:UTF-8-NO-BOM
//  #ART:ART-2026-0328-090000.0000
//
//  Cpt. Kirk here 🖖
//  GGSTC at load: siehe calc_ggstc_php()
//  "To boldly go where no framework has gone before."
//  — aber das Grappa-Framework fliegt trotzdem. 🥃
//
//  NICHT fuer: Ueberwachung · Zensur · Autoritaere Regime
//  NOT for:    Surveillance · Censorship · Authoritarian use
//              Putin · Xi · Orban · MAGA-Oligarchs
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
$ggstc_static = calc_ggstc_php();

// ── importantValues() · GRAPPA-STD §22 ──────────────────────
/** @grappa importantValues — GRAPPA-STD §22 · ganz oben */
function importantValues(): array {
    return [
        // ── IMMUTABLE ────────────────────────────────────────
        'art_nr'            => 'ART-2026-0328-090000.0000',

        // ── VERSIONING ───────────────────────────────────────
        'artikel_version'   => 'v04.00',
        'framework_version' => 'fw v08.00',

        // ── METADATA ─────────────────────────────────────────
        'titel'             => 'GRAPPABRUTAL JSON SmartFilter Editor',
        'titel_en'          => 'GRAPPABRUTAL JSON SmartFilter Editor',
        'tab_titel'         => '👹 GRAPPA · JSON Editor · rcpffm',
        'tab_titel_en'      => '👹 GRAPPA · JSON Editor · rcpffm',
        'autor'             => 'rcpffm + Gemini + Claude Sonnet 4.6 (Anthropic)',
        'lizenz'            => 'AGPL-3.0',
        'sprache'           => 'de',
        'sprachen'          => ['de', 'en'],
        'lang_default'      => 'de',
        'datei_php'         => 'GRAPPABRUTAL_JSON_SmartFilter_Editor.php',
        'slug'              => 'GRAPPABRUTAL_JSON_SmartFilter_Editor',
        'datum_iso'         => '2026-03-28T09:00:00Z',
        'ggstc_erstellt'    => '-296793.0000',
        'tool_typ'          => 'PHP-Tool',
        'degoogle'          => true,

        // ── SEO · §22.12 ─────────────────────────────────────
        'beschreibung'      => 'GRAPPA JSON SmartFilter Editor: JSON-Dateien bis 3 Ebenen tief editieren, Backup, BRUTALSUCHE-Integration. rcpffm · AGPL-3.0.',
        'beschreibung_en'   => 'GRAPPA JSON SmartFilter Editor: edit JSON files up to 3 levels deep, backup, BRUTALSUCHE integration. rcpffm · AGPL-3.0.',
        'keywords'          => 'GRAPPA, JSON, Editor, SmartFilter, BRUTALSUCHE, PHP-Tool, rcpffm, AGPL, CMS',
        'keywords_en'       => 'GRAPPA, JSON, editor, SmartFilter, BRUTALSUCHE, PHP tool, rcpffm, AGPL, CMS',
        'og_titel'          => 'GRAPPABRUTAL JSON SmartFilter Editor',
        'og_beschreibung'   => 'JSON-Dateien des GRAPPA FREE FRAMEWORK editieren · Backup · BRUTALSUCHE-Integration · rcpffm · AGPL-3.0.',
        'og_titel_en'       => 'GRAPPABRUTAL JSON SmartFilter Editor',
        'og_beschreibung_en'=> 'Edit GRAPPA FREE FRAMEWORK JSON files · backup · BRUTALSUCHE integration · rcpffm · AGPL-3.0.',

        // ── STORAGEKEY ───────────────────────────────────────
        'storageKey'        => 'grappabrutal_v4',
    ];
}
$iv = importantValues();

// ── Dateiliste *.json aus ./ ─────────────────────────────────
$docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '.');
$selfDir = realpath('.');

$jsonFiles  = [];
$jsonbakFiles = [];
foreach (glob('./*.json') as $f) {
    $jsonFiles[] = [
        'name'  => basename($f),
        'time'  => filemtime($f),
        'size'  => filesize($f),
    ];
}
foreach (glob('./*.jsonbak*') as $f) {
    $jsonbakFiles[] = [
        'name'  => basename($f),
        'time'  => filemtime($f),
        'size'  => filesize($f),
    ];
}
usort($jsonFiles,   fn($a, $b) => $b['time'] <=> $a['time']);
usort($jsonbakFiles, fn($a, $b) => $b['time'] <=> $a['time']);

// ── URL-Parameter · JsonPfadName= (BRUTALSUCHE-Schnittstelle) ─
// Unterstuetzt auch alten wasist= Parameter fuer Rueckwaertskompatibilitaet
$srcParam = $_GET['JsonPfadName'] ?? $_GET['wasist'] ?? '';

// ./ unterstellen wenn kein Pfad-Praefix
if ($srcParam !== '' && !str_starts_with($srcParam, './') && !str_starts_with($srcParam, '/')) {
    $srcParam = './' . $srcParam;
}

// Sicherheits-Check: nur innerhalb ./ erlaubt
$srcAbs = false;
if ($srcParam !== '') {
    $candidate = realpath($srcParam);
    if ($candidate !== false
        && str_starts_with($candidate . DIRECTORY_SEPARATOR, $selfDir . DIRECTORY_SEPARATOR)
        && strtolower(pathinfo($candidate, PATHINFO_EXTENSION)) === 'json'
    ) {
        $srcAbs = $candidate;
    }
}

// ── SAVE HANDLER (POST) ──────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['action'] ?? '') === 'save_json'
) {
    header('Content-Type: application/json; charset=UTF-8');
    $newData = $_POST['json_data'] ?? '';

    if (!$srcAbs || !is_writable($srcAbs)) {
        echo json_encode(['success' => false, 'error' => 'Kein Schreibzugriff auf Datei.']);
        exit;
    }

    // JSON-Syntax pruefen
    json_decode($newData);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'error' => 'Ungueltige JSON-Syntax: ' . json_last_error_msg()]);
        exit;
    }

    // Backup mit Timestamp
    $nowUTC     = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    $baseBackup = $srcAbs . '_' . $nowUTC->format('Y-m-d_H-i-s') . '.jsonbak';
    $idx = 1;
    while (file_exists($baseBackup . '_' . str_pad($idx, 5, '0', STR_PAD_LEFT))) { $idx++; }
    $finalBackup = $baseBackup . '_' . str_pad($idx, 5, '0', STR_PAD_LEFT);

    if (@copy($srcAbs, $finalBackup)) {
        file_put_contents($srcAbs, $newData, LOCK_EX);
        echo json_encode(['success' => true, 'backup' => basename($finalBackup)]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Backup fehlgeschlagen.']);
    }
    exit;
}

$srcJson     = ($srcAbs && is_readable($srcAbs)) ? file_get_contents($srcAbs) : '';
$srcBasename = $srcAbs ? basename($srcAbs) : '';
?>
<!DOCTYPE html>
<!--
  Cpt. Kirk here 🖖
  GGSTC at load: <?= $ggstc_static ?>

  importantValues() → art_nr: <?= $iv['art_nr'] ?> · version: <?= $iv['artikel_version'] ?>
  framework: <?= $iv['framework_version'] ?>

  "To boldly go where no framework has gone before."
  — aber das Grappa-Framework fliegt trotzdem. 🥃
-->
<html lang="de" class="lang-de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title id="page-title"><?= htmlspecialchars($iv['tab_titel']) ?></title>
<meta name="author"  content="<?= htmlspecialchars($iv['autor']) ?>">
<meta name="robots"  content="noindex, nofollow">
<meta name="license" content="AGPL-3.0">
<meta id="meta-desc" name="description" content="">
<meta id="meta-kw"   name="keywords"    content="">
<meta property="og:type"        content="website">
<meta property="og:title"       content="">
<meta property="og:description" content="">
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>👹</text></svg>">

<style>
*, *::before, *::after { box-sizing: border-box; }
body {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    background: #020617; color: #f8fafc;
    margin: 0; padding: 12px; font-size: 16px; line-height: 1.5;
}
.container { max-width: 900px; margin: auto; }

/* ── GRAPPA BADGE ── */
.grappa-badge {
    font-family: ui-monospace, 'Courier New', monospace;
    font-size: 0.72rem; color: #e8c87a;
    letter-spacing: 0.15em; text-transform: uppercase;
    margin-bottom: 0.4rem; opacity: 0.8;
}
.art-nr { color: #f0ede8; }

/* ── DRIFT BANNER · §19.8.5 ── */
#grappa-drift-banner {
    display: none;
    background: #8b0000; border: 2px solid #e8242a;
    border-radius: 6px; padding: 0.75rem 1rem; margin: 0.5rem 0;
    font-family: ui-monospace, monospace; font-size: 0.78rem; color: #fff;
    animation: grappa-drift-blink 1.4s ease-in-out infinite;
}
@keyframes grappa-drift-blink { 0%,100%{opacity:1} 50%{opacity:0.15} }

/* ── HEADER ── */
h1 { color: #e11d48; margin: 0 0 2px; font-size: 1.4em; display: inline; }
h3 { color: #f1f5f9; margin: 0 0 12px; font-size: 1.05em; }

/* ── VERSION DISPLAY · §26 ── */
#version-display {
    font-family: ui-monospace, monospace; font-size: 0.78rem;
    color: #4a9eff; text-decoration: underline;
    cursor: pointer; user-select: none; margin-left: 8px;
}

/* ── LANG BAR · §27 ── */
#lang-bar { display: flex; gap: 0.5rem; margin: 6px 0 10px; }
.lang-flag {
    background: none; border: 2px solid transparent;
    border-radius: 6px; font-size: 1.4rem; cursor: pointer;
    padding: 2px 5px; transition: border-color 0.2s; line-height: 1;
}
.lang-flag.active { border-color: #4a9eff; }
.lang-flag:hover  { border-color: rgba(74,158,255,0.5); }

/* ── i18n ── */
[data-de], [data-en] { display: none; }
.lang-de [data-de] { display: revert; }
.lang-en [data-en] { display: revert; }

/* ── CARD ── */
.card {
    background: #1e293b; border: 1px solid #334155;
    border-radius: 10px; padding: 16px; margin-bottom: 14px;
}

/* ── FILE LIST ── */
.file-item {
    display: flex; justify-content: space-between; align-items: center;
    padding: 10px 12px; border-radius: 7px; border: 1px solid #334155;
    text-decoration: none; color: #38bdf8; margin-bottom: 5px;
    background: #0f172a; transition: 0.15s;
    font-family: ui-monospace, monospace; font-size: 0.82rem;
}
.file-item:hover  { border-color: #3b82f6; background: #1e293b; }
.file-item.active { border-color: #10b981; background: rgba(16,185,129,0.12); color: #4ade80; }
.file-meta { text-align: right; font-size: 0.7rem; color: #64748b; }

/* ── FILEPICKER HINT ── */
.picker-hint {
    background: #0f172a; border: 1px dashed #f39c12;
    border-radius: 7px; padding: 14px; margin-top: 8px;
    font-size: 0.85rem; color: #f39c12; text-align: center;
}
.picker-hint input[type=file] {
    display: block; margin: 10px auto 0;
    background: #1e293b; color: #f8fafc;
    border: 1px solid #475569; border-radius: 5px;
    padding: 6px 10px; font-family: ui-monospace, monospace;
    font-size: 0.82rem; cursor: pointer; width: 100%;
}

/* ── BAK TOGGLE ── */
.bak-toggle {
    font-size: 0.78rem; color: #64748b; cursor: pointer;
    margin-top: 6px; display: inline-block; text-decoration: underline;
}
.bak-section { display: none; margin-top: 6px; }
.bak-section.open { display: block; }
.file-item.is-bak {
    opacity: 0.6; border-style: dashed; font-size: 0.78rem;
    margin-left: 14px; color: #94a3b8;
}

/* ── EDITOR ── */
.level-box {
    border-left: 3px solid #e11d48;
    margin-left: 12px; padding-left: 14px; margin-top: 12px;
}
.level-box-2 { border-left-color: #f39c12; }
.level-box-3 { border-left-color: #4a9eff; }

.field-wrap { margin-bottom: 12px; }
.field-label {
    font-size: 0.72rem; color: #94a3b8;
    display: block; margin-bottom: 3px; font-weight: 700;
    font-family: ui-monospace, monospace;
}
.field-type { opacity: 0.45; font-weight: 400; }
.field-key  { color: #e8c87a; }

.field-input {
    background: #020617; color: #fbbf24;
    border: 1px solid #475569; padding: 8px 10px;
    border-radius: 5px; width: 100%;
    font-family: ui-monospace, monospace; font-size: 0.85rem;
    transition: border-color 0.15s;
}
.field-input:focus { outline: none; border-color: #4a9eff; }
.field-input.modified { border-color: #f39c12; background: #1a1000; }

.obj-header {
    color: #e11d48; font-size: 0.78rem; font-weight: 700;
    font-family: ui-monospace, monospace; margin-bottom: 2px;
}
.level-lock { color: #e11d48; font-size: 0.72rem; opacity: 0.6; }

/* ── SAVE BUTTON ── */
.btn-save {
    background: #059669; color: #fff;
    padding: 13px 20px; border-radius: 7px; border: none;
    font-weight: 700; width: 100%; cursor: pointer;
    font-size: 0.95rem; margin-top: 18px;
    text-transform: uppercase; letter-spacing: 0.05em;
    transition: background 0.2s;
}
.btn-save:hover { background: #047857; }
.btn-save:disabled { background: #334155; cursor: not-allowed; }

/* ── STATUS ── */
.status-ok  { color: #4ade80; font-size: 0.82rem; margin-top: 6px; }
.status-err { color: #f87171; font-size: 0.82rem; margin-top: 6px; }

/* ── FOOTER ── */
.site-footer {
    border-top: 1px solid rgba(232,200,122,0.15);
    margin-top: 2rem; padding-top: 1rem;
    font-family: ui-monospace, monospace;
    font-size: 0.7rem; color: #555; line-height: 2;
}

/* ── RWD ── */
@media (max-width: 600px) {
    body { padding: 8px; font-size: 14px; }
    h1 { font-size: 1.2em; }
}
</style>
</head>
<body>
<div class="container">

<!-- ── DRIFT BANNER · §22.8 ── -->
<div id="grappa-drift-banner" role="alert" aria-live="assertive">
  <strong style="color:#ffaaaa;">⚠ GRAPPA DRIFT DETECTED</strong><br>
  <span id="grappa-drift-details">…</span>
</div>

<!-- ── HEADER ── -->
<div class="grappa-badge" id="grappa-badge">
  👹 GRAPPA FREE FRAMEWORK · <?= htmlspecialchars($iv['framework_version']) ?> · <span class="art-nr"><?= htmlspecialchars($iv['art_nr']) ?></span>
</div>
<div>
  <h1 id="artikel-h1">👹 GRAPPABRUTAL JSON Editor</h1>
  <span id="version-display" title="3× klicken für eruda Debug-Konsole (§26)" role="button" tabindex="0">
    <?= htmlspecialchars($iv['framework_version']) ?> · <?= htmlspecialchars($iv['artikel_version']) ?>
  </span>
</div>

<!-- ── LANG BAR · §27 ── -->
<div id="lang-bar" aria-label="Sprache / Language">
  <button class="lang-flag active" onclick="setLang('de')" aria-label="Deutsch" title="Deutsch">🇩🇪</button>
  <button class="lang-flag"       onclick="setLang('en')" aria-label="English"  title="English">🇬🇧</button>
</div>

<!-- ── JSON FILE LIST ── -->
<div class="card">
  <h3>
    <span data-de>📋 JSON-Dateien in ./</span>
    <span data-en>📋 JSON files in ./</span>
  </h3>

  <?php if (count($jsonFiles) === 0): ?>
    <div style="color:#64748b; font-size:0.85rem;">
      <span data-de>Keine *.json-Dateien im Verzeichnis gefunden.</span>
      <span data-en>No *.json files found in directory.</span>
    </div>
  <?php else: ?>
    <div style="max-height:320px; overflow-y:auto;">
    <?php foreach ($jsonFiles as $f):
        $isActive = ($srcParam === './' . $f['name'] || $srcParam === $f['name']);
        $itemUrl  = '?JsonPfadName=./' . rawurlencode($f['name']);
    ?>
      <a href="<?= htmlspecialchars($itemUrl) ?>"
         class="file-item <?= $isActive ? 'active' : '' ?>">
        <span>💎 <?= htmlspecialchars($f['name']) ?></span>
        <span class="file-meta">
          <?= date('d.m.y H:i', $f['time']) ?><br>
          <?= round($f['size'] / 1024, 1) ?> KB
        </span>
      </a>
    <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if (count($jsonbakFiles) > 0): ?>
    <span class="bak-toggle" onclick="toggleBak()">
      <span data-de>📜 <?= count($jsonbakFiles) ?> Backup(s) anzeigen</span>
      <span data-en>📜 Show <?= count($jsonbakFiles) ?> backup(s)</span>
    </span>
    <div class="bak-section" id="bak-section">
      <?php foreach ($jsonbakFiles as $f):
          $bakUrl = '?JsonPfadName=./' . rawurlencode($f['name']);
      ?>
        <a href="<?= htmlspecialchars($bakUrl) ?>" class="file-item is-bak">
          <span>📜 <?= htmlspecialchars($f['name']) ?></span>
          <span class="file-meta"><?= date('d.m.y H:i', $f['time']) ?> · <?= round($f['size']/1024,1) ?> KB</span>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<!-- ── FILEPICKER FALLBACK · wenn kein JsonPfadName oder Datei nicht gefunden ── -->
<?php if ($srcParam !== '' && !$srcAbs): ?>
<div class="card">
  <div class="picker-hint">
    <span data-de>⚠ Datei <strong><?= htmlspecialchars($srcParam) ?></strong> nicht gefunden in ./</span>
    <span data-en>⚠ File <strong><?= htmlspecialchars($srcParam) ?></strong> not found in ./</span>
    <br><br>
    <span data-de>Datei auswählen (nur *.json aus ./):</span>
    <span data-en>Select file (*.json from ./ only):</span>
    <input type="file" id="filepicker" accept=".json" onchange="handleFilepick(this)">
    <div id="picker-status" style="margin-top:8px; font-size:0.78rem; color:#94a3b8;"></div>
  </div>
</div>
<?php elseif ($srcParam === ''): ?>
<div class="card">
  <div class="picker-hint">
    <span data-de>👆 Datei aus der Liste wählen — oder direkt eine JSON-Datei öffnen:</span>
    <span data-en>👆 Select a file from the list — or open a JSON file directly:</span>
    <input type="file" id="filepicker" accept=".json" onchange="handleFilepick(this)">
    <div id="picker-status" style="margin-top:8px; font-size:0.78rem; color:#94a3b8;"></div>
  </div>
</div>
<?php endif; ?>

<!-- ── EDITOR ── -->
<?php if ($srcJson): ?>
<div class="card" id="editor-ui">
  <h3>
    🛠 <span data-de>Bearbeite:</span><span data-en>Editing:</span>
    <span style="color:#4ade80; font-family:ui-monospace,monospace;">
      <?= htmlspecialchars($srcBasename) ?>
    </span>
  </h3>
  <div id="editor-root"></div>
  <button class="btn-save" id="btn-save" onclick="prepareSave()">
    <span data-de>💾 Speichern & Backup erstellen</span>
    <span data-en>💾 Save & create backup</span>
  </button>
  <div id="save-status"></div>
</div>
<textarea id="inp" style="display:none;"><?= htmlspecialchars($srcJson) ?></textarea>
<?php endif; ?>

<!-- ── FOOTER ── -->
<footer class="site-footer">
  <p>👹 GRAPPA FREE FRAMEWORK · <?= htmlspecialchars($iv['framework_version']) ?> · AGPL-3.0</p>
  <p>
    <span data-de>Version:</span><span data-en>Version:</span>
    <span id="footer-art-ver"><?= htmlspecialchars($iv['artikel_version']) ?></span> ·
    <span data-de>Artikel:</span><span data-en>Article:</span>
    <span id="footer-art"><?= htmlspecialchars($iv['art_nr']) ?></span>
  </p>
  <p>🖖 „To boldly go where no framework has gone before." — USS GRAPPA NCC-rcpffm-claude</p>
</footer>
</div><!-- /.container -->

<script>
// ── importantValues JS-Spiegel · §22 ────────────────────────
var IV = {
    art_nr:            '<?= addslashes($iv['art_nr']) ?>',
    artikel_version:   '<?= addslashes($iv['artikel_version']) ?>',
    framework_version: '<?= addslashes($iv['framework_version']) ?>',
    datei_php:         '<?= addslashes($iv['datei_php']) ?>',
    beschreibung:      '<?= addslashes($iv['beschreibung']) ?>',
    keywords:          '<?= addslashes($iv['keywords']) ?>',
    titel:             '<?= addslashes($iv['titel']) ?>',
    titel_en:          '<?= addslashes($iv['titel_en']) ?>',
    tab_titel:         '<?= addslashes($iv['tab_titel']) ?>',
    tab_titel_en:      '<?= addslashes($iv['tab_titel_en']) ?>',
    lang_default:      '<?= addslashes($iv['lang_default']) ?>'
};

// ── validateImportantValues() · §22.8 ───────────────────────
(function() {
    fetch('./' + IV.art_nr + '.json')
        .then(function(r) {
            if (!r.ok) throw new Error('HTTP ' + r.status);
            return r.json();
        })
        .then(function(data) {
            var checks = [
                ['art_nr → art',      String(data['art']               || ''), IV.art_nr],
                ['artikel_version',   String(data['artikel_version']   || ''), IV.artikel_version],
                ['framework_version', String(data['framework_version'] || ''), IV.framework_version],
                ['datei_php',         String(data['datei_php']         || ''), IV.datei_php],
            ];
            var drifts = [];
            checks.forEach(function(c) {
                if (c[1] !== c[2])
                    drifts.push(c[0] + ': IV=' + JSON.stringify(c[2]) + ' ≠ JSON=' + JSON.stringify(c[1]));
            });
            if (drifts.length > 0) {
                var b = document.getElementById('grappa-drift-banner');
                var d = document.getElementById('grappa-drift-details');
                if (b && d) { d.textContent = drifts.join(' · '); b.style.display = 'block'; }
                console.error('⚠ GRAPPA DRIFT:', drifts);
            } else {
                console.log('✅ GRAPPA validateImportantValues: OK · ' + IV.art_nr + ' · ' + IV.artikel_version);
            }
        })
        .catch(function(e) {
            console.log('GRAPPA validate: JSON nicht erreichbar (' + e.message + ')');
        });
})();

// ── SEO DOM-Patches · §22.12 ────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    var md = document.getElementById('meta-desc');
    if (md) md.content = '<?= addslashes($iv['beschreibung']) ?>';
    var mk = document.getElementById('meta-kw');
    if (mk) mk.content = '<?= addslashes($iv['keywords']) ?>';
    var ogt = document.querySelector('meta[property="og:title"]');
    if (ogt) ogt.content = '<?= addslashes($iv['og_titel']) ?>';
    var ogd = document.querySelector('meta[property="og:description"]');
    if (ogd) ogd.content = '<?= addslashes($iv['og_beschreibung']) ?>';
});

// ── setLang() · §27 ─────────────────────────────────────────
function setLang(lang) {
    document.documentElement.lang = lang;
    document.documentElement.className = 'lang-' + lang;
    document.title = (lang === 'en' && IV.tab_titel_en) ? IV.tab_titel_en : IV.tab_titel;
    var h1 = document.getElementById('artikel-h1');
    if (h1) h1.textContent = (lang === 'en') ? '👹 GRAPPABRUTAL JSON Editor' : '👹 GRAPPABRUTAL JSON Editor';
    document.querySelectorAll('.lang-flag').forEach(function(btn) {
        btn.classList.toggle('active', btn.getAttribute('aria-label').toLowerCase() === (lang === 'de' ? 'deutsch' : 'english'));
    });
    try { localStorage.setItem('grappa_lang', lang); } catch(e) {}
}
// Init Sprache
(function() {
    var saved; try { saved = localStorage.getItem('grappa_lang'); } catch(e) {}
    setLang(saved || IV.lang_default || 'de');
})();

// ── eruda · 3×Klick auf #version-display · §26 ──────────────
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

// ── Bak-Toggle ──────────────────────────────────────────────
function toggleBak() {
    var s = document.getElementById('bak-section');
    if (s) s.classList.toggle('open');
}

// ── Filepicker Fallback ──────────────────────────────────────
// Liest Datei lokal per FileReader und baut Editor clientseitig
// (Speichern geht dann NICHT serverseitig -- zeigt Hinweis)
function handleFilepick(input) {
    var file = input.files[0];
    if (!file) return;
    var status = document.getElementById('picker-status');
    if (status) {
        status.textContent = '';
    }
    // Versuche URL zu navigieren wenn Name in ./ passt
    var fname = file.name;
    if (fname.endsWith('.json')) {
        // Pruefe ob Datei im Server-Listing bekannt (naive Pruefung via Navigation)
        var url = '?JsonPfadName=./' + encodeURIComponent(fname);
        window.location.href = url;
        return;
    }
    if (status) {
        status.textContent = 'Nur *.json-Dateien erlaubt.';
        status.style.color = '#f87171';
    }
}

// ── JSON EDITOR ─────────────────────────────────────────────
var originalData = null, workingData = null, hasChanges = false;

document.addEventListener('DOMContentLoaded', function() {
    var inp = document.getElementById('inp');
    if (!inp) return;
    try {
        originalData = JSON.parse(inp.value);
        workingData  = JSON.parse(JSON.stringify(originalData));
        renderLevel(workingData, document.getElementById('editor-root'), 1, '');
        console.log('GRAPPABRUTAL Editor: geladen · ' + Object.keys(workingData).length + ' Keys (Ebene 1)');
    } catch(e) {
        document.getElementById('editor-root').innerHTML =
            '<div style="color:#f87171;">⚠ JSON Parse-Fehler: ' + e.message + '</div>';
        console.error('GRAPPABRUTAL Editor JSON-Fehler:', e);
    }

    // U-01: Zuletzt bearbeitete JSON in URL aufnehmen
    var curParam = '<?= addslashes($srcParam) ?>';
    if (curParam && window.history && window.history.replaceState) {
        var url = new URL(window.location.href);
        url.searchParams.set('JsonPfadName', curParam);
        window.history.replaceState({}, '', url.toString());
    }
});

function renderLevel(obj, parentEl, depth, path) {
    if (depth > 3) {
        var lock = document.createElement('div');
        lock.className = 'level-lock';
        lock.textContent = '[LEVEL LOCK · max. 3 Ebenen]';
        parentEl.appendChild(lock);
        return;
    }
    var container = document.createElement('div');
    container.className = 'level-box level-box-' + depth;

    Object.keys(obj).forEach(function(key) {
        var currentPath = path ? path + '.' + key : key;
        var val = obj[key];
        var wrap = document.createElement('div');
        wrap.className = 'field-wrap';

        if (Array.isArray(val)) {
            // Arrays: als editierbaren JSON-String darstellen
            var lbl = document.createElement('span');
            lbl.className = 'field-label';
            lbl.innerHTML = '<span class="field-key">' + escHtml(key) + '</span>'
                + ' <span class="field-type">(array · ' + val.length + ')</span>';
            var inp = document.createElement('input');
            inp.type = 'text';
            inp.className = 'field-input';
            inp.value = JSON.stringify(val);
            inp.dataset.path = currentPath;
            inp.dataset.type = 'array';
            inp.addEventListener('change', onFieldChange);
            wrap.appendChild(lbl);
            wrap.appendChild(inp);
        } else if (typeof val === 'object' && val !== null) {
            var lbl = document.createElement('span');
            lbl.className = 'obj-header';
            lbl.textContent = '📂 ' + key;
            wrap.appendChild(lbl);
            renderLevel(val, wrap, depth + 1, currentPath);
        } else {
            var lbl = document.createElement('span');
            lbl.className = 'field-label';
            lbl.innerHTML = '<span class="field-key">' + escHtml(key) + '</span>'
                + ' <span class="field-type">(' + typeof val + ')</span>';
            var inp = document.createElement('input');
            inp.type = 'text';
            inp.className = 'field-input';
            inp.value = String(val);
            inp.dataset.path = currentPath;
            inp.dataset.type = typeof val;
            inp.addEventListener('change', onFieldChange);
            wrap.appendChild(lbl);
            wrap.appendChild(inp);
        }
        container.appendChild(wrap);
    });
    parentEl.appendChild(container);
}

function escHtml(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function onFieldChange(e) {
    var inp = e.target;
    updateValue(inp.dataset.path, inp.value, inp.dataset.type);
    inp.classList.add('modified');
    hasChanges = true;
    var btn = document.getElementById('btn-save');
    if (btn) btn.style.background = '#d97706'; // orange wenn ungespeichert
}

function updateValue(path, newVal, type) {
    var parts = path.split('.'), curr = workingData;
    for (var i = 0; i < parts.length - 1; i++) { curr = curr[parts[i]]; }
    var key = parts[parts.length - 1];
    if (type === 'number')  { curr[key] = Number(newVal); }
    else if (type === 'boolean') { curr[key] = (newVal.trim().toLowerCase() === 'true'); }
    else if (type === 'array') {
        try { curr[key] = JSON.parse(newVal); }
        catch(e) { curr[key] = newVal; } // Fallback: String
    }
    else { curr[key] = newVal; }
}

async function prepareSave() {
    var de = document.documentElement.className.indexOf('lang-en') === -1;
    var msg = de
        ? 'Daten wirklich überschreiben?\nEin Backup wird automatisch erstellt.'
        : 'Really overwrite data?\nA backup will be created automatically.';
    if (!confirm(msg)) return;

    var btn = document.getElementById('btn-save');
    if (btn) { btn.disabled = true; }

    var fd = new FormData();
    fd.append('action', 'save_json');
    fd.append('json_data', JSON.stringify(workingData, null, 2));

    try {
        var res  = await fetch(window.location.href, { method: 'POST', body: fd });
        var data = await res.json();
        var st   = document.getElementById('save-status');
        if (data.success) {
            hasChanges = false;
            if (btn) { btn.disabled = false; btn.style.background = '#059669'; }
            if (st) {
                st.className = 'status-ok';
                st.textContent = (de ? '✅ Gespeichert · Backup: ' : '✅ Saved · Backup: ') + data.backup;
            }
            console.log('GRAPPABRUTAL: gespeichert · Backup: ' + data.backup);
        } else {
            if (btn) { btn.disabled = false; }
            if (st) {
                st.className = 'status-err';
                st.textContent = '❌ ' + data.error;
            }
            console.error('GRAPPABRUTAL Speicherfehler:', data.error);
        }
    } catch(e) {
        if (btn) btn.disabled = false;
        var st = document.getElementById('save-status');
        if (st) { st.className = 'status-err'; st.textContent = '❌ Netzwerkfehler: ' + e.message; }
        console.error('GRAPPABRUTAL fetch-Fehler:', e);
    }
}

// ── GGSTC JS-Fallback ────────────────────────────────────────
(function() {
    // Kein Display hier noetig -- nur Boot-Log
    function calcGgstc() {
        var now = new Date(), year = now.getUTCFullYear();
        var start = Date.UTC(year,0,1);
        var doy = Math.floor((Date.UTC(year,now.getUTCMonth(),now.getUTCDate())-start)/86400000)+1;
        var isLeap = (year%4===0&&(year%100!==0||year%400===0));
        var sec = now.getUTCHours()*3600+now.getUTCMinutes()*60+now.getUTCSeconds();
        return ((year-2323)*1000+(doy/(isLeap?366:365))*1000+(sec/86400)).toFixed(4);
    }
    console.log('GRAPPABRUTAL · ' + IV.datei_php + ' · ' + IV.artikel_version + ' · ' + IV.framework_version + ' · GGSTC ' + calcGgstc());
})();

// ── URL: action nach Ausfuehrung entfernen · U-01 ────────────
if (window.history && window.history.replaceState) {
    var url = new URL(window.location.href);
    var toDelete = [];
    url.searchParams.forEach(function(value, key) {
        if (!value || value === '') toDelete.push(key);
    });
    toDelete.forEach(function(k) { url.searchParams.delete(k); });
    window.history.replaceState({}, '', url.toString());
}
</script>
</body>
</html>
