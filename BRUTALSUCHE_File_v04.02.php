<?php
// ═══════════════════════════════════════════════════════════════
//      GRAPPA FREE FRAMEWORK · AGPL-3.0 · COPYRIGHT Notice 
// ═══════════════════════════════════════════════════════════════
//      Copyright (C) 2026 rcpffm
//      https://github.com/rcpffm/rcpffm
//
//      DE: Dieses Werk ist lizenziert unter der
//          GNU Affero General Public License Version 3 (AGPL-3.0).
//          Nutzung, Veränderung und Weitergabe nur unter gleichen
//          Bedingungen. Bei Netzwerk-Nutzung muss der Quellcode
//          zugänglich gemacht werden.
//          Vollständige Lizenz:
//          https://www.gnu.org/licenses/agpl-3.0.html
//
//      EN: This work is licensed under the
//          GNU Affero General Public License Version 3 (AGPL-3.0).
//          Use, modification and distribution only under same terms.
//          Source code must be made available when used over a network.
//          Full license:
//          https://www.gnu.org/licenses/agpl-3.0.html
//
//      ⚠ DE: Das Entfernen oder Ändern dieses Hinweises verletzt
//             AGPL-3.0 §7(b) und entzieht alle eingeräumten Rechte.
//      ⚠ EN: Removing or altering this notice violates AGPL-3.0
//             §7(b) and terminates all granted rights.
//
//      NICHT für: Überwachung · Zensur · Autoritäre Regime
//                 Oligarchen · Putin · Xi · MAGA
//      NOT for:   Surveillance · Censorship · Authoritarian use
//                 Oligarchs · Data Hoarders
//
//      RESILIENCE BY DESIGN — No Single Point of Failure
//      Distributed · Censorship-Resistant · AGPL-3.0
// ═══════════════════════════════════════════════════════════════
//
//  BRUTALSUCHE_File.php
//  Part of GRAPPA FREE FRAMEWORK
//  https://github.com/rcpffm/rcpffm
//
//  Cpt. Kirk here 🖖
//  "To boldly go where no framework has gone before."
//  — USS GRAPPA NCC-rcpffm-claude 🥃
//
//  #TAG:GRAPPA-STD #AUTHOR:rcpffm #VER:v04.03
//  #UTC:2026-04-20T12:00:00Z #GRAPPA:fw v08.00
//  #LICENSE:AGPL-3.0 #ENCODING:UTF-8-NO-BOM
//  #ART:ART-2026-0317-172900.0000
//
//  NEU v04.02:
//    + SEO DE+EN: beschreibung/keywords/og_* zweisprachig · gezielt · mit Augenzwinkern
//    + robots: noindex,nofollow (Tool · kein öffentlicher Artikel)
//
//  NEU v04.01:
//    + Vollständiger Kirk-Copyright-Block · AGPL-3.0 §7(b) · CR-01..06
//    + Klassen-Kapselung: GrappaSearch · GrappaGrep · GrappaCheckArt
//                         GrappaSound · GrappaExport · GrappaUrl
//    + GrappaSound::fireworks() · Web Audio · als Klasse · erweiterbar
//    + i18n-Vorbereitung: titel_en · keywords_en · beschreibung_en in IV
//    + art_nr → art (OP-54) · key-Feld entfernt aus buildGrappaArtifact()
//    + lsfilter-URL-Übergabe: ?q1= mit aktuellem Pattern vorbelegt
//    + BRUTALSUCHE→lsfilter-Bridge: Button übergibt Pattern per URL
//    + GrappaExport: JSON-Export UTC_SERVER_DIR.json · merge-fähig
//    + URL-Parameter Sonderzeichen: encodeURIComponent-Hinweis dokumentiert
//    + Alle v03.06-Features integriert
// ═══════════════════════════════════════════════════════════════

// ── GGSTC PHP ───────────────────────────────────────────────────
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

// ── importantValues() · GRAPPA-STD §22 ──────────────────────────
function importantValues(): array {
    return [
        // ── IMMUTABLE ───────────────────────────────────────────
        'art_nr'            => 'ART-2026-0317-172900.0000',
        // OP-54: 'key' entfernt · 'art' ist alleiniger Schlüssel

        // ── VERSIONING ──────────────────────────────────────────
        'artikel_version'   => 'v04.03',
        'framework_version' => 'fw v08.00',
        'schema_version'    => 'v08.00-3',

        // ── METADATA DE ─────────────────────────────────────────
        'titel'             => 'BRUTALSUCHE_File — GRAPPA Datei- und Inhaltssuche',
        'subtitle'          => 'BRUTALSUCHE · Datei · Grep · Index · GRAPPA',
        'beschreibung'      => 'BRUTALSUCHE_File: Datei- und Inhaltssuche für das GRAPPA FREE FRAMEWORK. Glob, Regex, Grep, ART-Key-Index, Konsistenzprüfung, JSON-Export. Für alle, die ihr CMS selbst kontrollieren wollen — und nicht fragen müssen ob das erlaubt ist. rcpffm · AGPL-3.0 · kein Abo · kein Tracking · kein Lock-in.',
        'keywords'          => 'GRAPPA FREE FRAMEWORK, BRUTALSUCHE, PHP Dateisuche, Regex Grep PHP Tool, verteiltes CMS, dezentrales CMS, AGPL-3.0, Open Source CMS, ART-Key Index, Konsistenzprüfung, Filesystem Browser PHP, zensurresistent, rcpffm, No Single Point of Failure, offline-fähig',

        // ── METADATA EN · i18n-Vorbereitung §27 ─────────────────
        'titel_en'          => 'BRUTALSUCHE_File — GRAPPA File and Content Search',
        'subtitle_en'       => 'BRUTALSUCHE · File · Grep · Index · GRAPPA',
        'beschreibung_en'   => 'BRUTALSUCHE_File: File and content search for the GRAPPA FREE FRAMEWORK. Glob, regex, grep, ART-key index, consistency check, JSON export. For everyone who wants to control their own CMS — without asking permission. rcpffm · AGPL-3.0 · no subscription · no tracking · no lock-in.',
        'keywords_en'       => 'GRAPPA FREE FRAMEWORK, BRUTALSUCHE, PHP file search, regex grep PHP tool, distributed CMS, decentralized CMS, AGPL-3.0, open source CMS, ART-key index, consistency check, filesystem browser PHP, censorship-resistant, rcpffm, no single point of failure, offline capable, resilient publishing system',

        // ── SEO OG ───────────────────────────────────────────────
        'og_titel'          => 'BRUTALSUCHE_File · GRAPPA Dateisuche · kein Abo · kein Tracking',
        'og_titel_en'       => 'BRUTALSUCHE_File · GRAPPA File Search · no subscription · no tracking',
        'og_beschreibung'   => 'Glob, Regex, Grep, ART-Index in einem PHP-Tool. AGPL-3.0. Läuft auf InfinityFree, alwaysdata und allem dazwischen. Keine Cloud die deine Daten kennt besser als du.',
        'og_beschreibung_en'=> 'Glob, regex, grep, ART-index in one PHP tool. AGPL-3.0. Runs on InfinityFree, alwaysdata, and everything in between. No cloud that knows your data better than you do.',

        // ── COPYRIGHT · CR-01..06 ────────────────────────────────
        'copyright'         => 'Copyright (C) 2026 rcpffm',
        'lizenz'            => 'AGPL-3.0',
        'lizenz_url'        => 'https://www.gnu.org/licenses/agpl-3.0.html',
        'quellcode'         => 'https://github.com/rcpffm/rcpffm',

        // ── TOOL-KONTEXT ─────────────────────────────────────────
        'tool_typ'          => 'PHP-Tool',
        'sprache'           => 'de',
        'sprachen'          => ['de', 'en'],   // i18n-Vorbereitung
        'degoogle'          => true,
        'datei_php'         => 'BRUTALSUCHE_File.php',
        'datei_json'        => 'ART-2026-0317-172900.0000.json',
        'autor'             => 'rcpffm + Claude Sonnet 4.6 (Anthropic)',

        // ── SEARCH PRESETS ───────────────────────────────────────
        'search_presets'    => [
            'core_fields' => [
                'slug', 'artikel_version', 'titel', 'beschreibung',
                'subtitle', 'sprache', 'relatedTo', 'objekte', 'last_modified',
            ],
        ],

        // ── INDEX GENERATOR CONFIG ───────────────────────────────
        'index_generator'   => [
            'template_placeholder_prefix' => '%%',
            'template_placeholder_suffix' => '%%',
            'bak_rotation_limit'          => 3,
            'sort_by'                     => 'last_modified',
        ],

        // ── WARNSYSTEM ───────────────────────────────────────────
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

        // ── CHANGELOG ────────────────────────────────────────────
        'schema_changelog'  => [
            'v08.00-3: v03.00 · GRAPPA-Artikel Schema · CMS-Steuerung',
            'v08.00-3: v03.01 · SEO-Felder · validateImportantValues()',
            'v08.00-3: v03.02 · URL-Persistenz · check_art',
            'v08.00-3: v03.03 · Default-Filter · ART-Links SmartFilter',
            'v08.00-3: v03.04 · Regex-Validierung · Pattern-Schnellwahl',
            'v08.00-3: v03.05 · Regex-Delimiter auto · Glob Multi-Pattern',
            'v08.00-3: v03.06 · Grep /regex/ Erkennung · Grep-Fehler-Banner',
            'v08.00-3: v04.01 · Klassen · Kirk-Copyright · i18n-Vorbereitung · GrappaSound · Export',
        ],

        'flags'             => ['tool','php','fw-v08','search','grep','regex','index','agpl'],
        'status'            => 'aktiv',
        'ggstc_erstellt'    => 'n/a',
        'relatedTo_count'   => 0,
        'relatedTo'         => [],
    ];
}
$iv = importantValues();

// ═══════════════════════════════════════════════════════════════
//  KLASSEN · Jede Klasse eigenständig importierbar
// ═══════════════════════════════════════════════════════════════

/**
 * GrappaSearch · Dateifilterung · Glob + Regex
 * Eigenständig verwendbar in lsfilter, grappa_check etc.
 */
class GrappaSearch {
    // ART-Regex: rcpffm + Gemini · Datumslogik 2026–2399 · Schaltjahre korrekt
    const ART_JSON_RE = '/^ART-((202[6-9]|20[3-9]\d|2[1-3]\d{2})-((0[13578]|1[02])(0[1-9]|[12]\d|3[01])|(0[469]|11)(0[1-9]|[12]\d|30)|02(0[1-9]|1\d|2[0-8]))|((20(28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)|(21|22|23)(04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)))-0229)-\d{6}\.\d{4}\.json$/';
    const GRAPPA_EXTS = ['html','htm','php','json','jsontxt','md'];

    /**
     * Regex-Delimiter ergänzen wenn fehlend: \.(html|php)$ → /\.(html|php)$/
     */
    public static function normalizeRegex(string $rx): string {
        $rx = trim($rx);
        if ($rx === '') return $rx;
        $first = $rx[0];
        if (!ctype_alnum($first) && $first !== '\\' && $first !== ' ') {
            $pos = strrpos($rx, $first, 1);
            if ($pos > 0) return $rx;
        }
        return '/' . $rx . '/';
    }

    /**
     * Case-insensitive Flag hinzufügen
     */
    public static function addCaseFlag(string $r): string {
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

    /**
     * Glob-Pattern zu Regex konvertieren
     * Mehrere Patterns per Leerzeichen: *.html *.php
     */
    public static function globToRegex(string $glob, bool $ci = false): string|false {
        $regex = ''; $inClass = false; $len = strlen($glob);
        for ($i = 0; $i < $len; $i++) {
            $c = $glob[$i];
            switch ($c) {
                case '*': $regex .= '.*'; break;
                case '?': $regex .= '.'; break;
                case '[':
                    if ($inClass) return false;
                    $inClass = true; $regex .= '[';
                    if ($i+1 < $len && in_array($glob[$i+1],['!','^'])) { $regex .= '^'; $i++; }
                    break;
                case ']': if (!$inClass) return false; $inClass = false; $regex .= ']'; break;
                case '\\': $i++; $regex .= ($i < $len) ? '\\'.preg_quote($glob[$i],'/') : '\\\\'; break;
                default: $regex .= preg_quote($c, '/');
            }
        }
        if ($inClass) return false;
        $base = '/^'.$regex.'$/';
        return $ci ? self::addCaseFlag($base) : $base;
    }

    /**
     * Dateien filtern · gibt gefilterte $fileInfo zurück + Fehler
     */
    public static function filter(
        array $fileInfo,
        string $pattern,
        bool $useRegex,
        bool $noCase
    ): array {
        $error = '';
        if ($pattern === '') {
            $filtered = array_filter($fileInfo, fn($f) => in_array($f['ext'], self::GRAPPA_EXTS, true));
        } elseif ($useRegex) {
            $rx = self::normalizeRegex($pattern);
            $rx = $noCase ? self::addCaseFlag($rx) : $rx;
            if (@preg_match($rx, '') === false) {
                $error = 'Ungültiger Regex: ' . $pattern
                       . ' · Tipp: Glob (Regex ☐): *.html  oder  Regex (☑): \\.(html|php)$';
                $filtered = [];
            } else {
                $filtered = array_filter($fileInfo, fn($f) => @preg_match($rx, $f['name']) === 1);
            }
        } else {
            // Glob-Modus · mehrere Patterns per Leerzeichen
            $patterns = array_filter(array_map('trim', explode(' ', $pattern)));
            $filtered = array_filter($fileInfo, function($f) use ($patterns, $noCase) {
                foreach ($patterns as $pat) {
                    $rx = self::globToRegex($pat, $noCase);
                    if ($rx !== false && preg_match($rx, $f['name']) === 1) return true;
                }
                return false;
            });
        }
        return ['files' => array_values($filtered), 'error' => $error];
    }

    /**
     * ART-Nr-Index aus Dateiliste
     */
    public static function artIndex(array $files): array {
        $idx = [];
        foreach ($files as $f) {
            if (preg_match('/^(ART-\d{4}-\d{4}-\d{6}\.\d{4})\.json$/', $f['name'], $m))
                $idx[] = $m[1];
        }
        return $idx;
    }
}

/**
 * GrappaGrep · Inhaltssuche · Regex + String
 * Eigenständig verwendbar
 */
class GrappaGrep {
    /**
     * Ist der Grep-String ein Regex? (beginnt mit /.../)
     */
    public static function isRegex(string $s): bool {
        $s = trim($s);
        if (strlen($s) < 2 || $s[0] !== '/') return false;
        return strrpos($s, '/', 1) > 0;
    }

    /**
     * Auto-Regex aus Key-Liste generieren (Lookaheads)
     */
    public static function autoRegexFromKeys(string $keyList): string {
        $keys = array_filter(array_map('trim', explode("\n", $keyList)));
        if (empty($keys)) return '';
        $la = array_map(fn($k) => '(?=.*"'.preg_quote($k,'/').'":)', $keys);
        return '/^'.implode('', $la).'/s';
    }

    /**
     * Grep ausführen · gibt Ergebnisse + Fehler zurück
     */
    public static function run(
        array $files,
        string $dir,
        string $grepStr,
        bool $isRegex,
        bool $noCase,
        bool $wholeFile
    ): array {
        $results = []; $error = '';

        // Regex vorab validieren
        if ($isRegex) {
            if (@preg_match($grepStr, '') === false) {
                $error = 'Ungültiger Grep-Regex: '.$grepStr
                       . ' · Tipp: /Hegel/ oder /(Lao|Hegel)/ · String-Suche ohne /-Delimiter';
                return ['results' => [], 'total' => 0, 'error' => $error];
            }
        }

        foreach ($files as $f) {
            $abs = $dir.DIRECTORY_SEPARATOR.$f['name'];
            if ($wholeFile) {
                $content = @file_get_contents($abs);
                if ($content === false) continue;
                $hit = $isRegex
                    ? (@preg_match($grepStr, $content) === 1)
                    : ($noCase ? stripos($content,$grepStr)!==false : strpos($content,$grepStr)!==false);
                if ($hit) {
                    $results[$f['name']] = [['line'=>0,'text'=>'(Ganzdatei-Treffer)']];
                }
            } else {
                $handle = @fopen($abs, 'r');
                if (!$handle) continue;
                $lines = []; $ln = 0;
                while (($line = fgets($handle)) !== false) {
                    $ln++;
                    $hit = $isRegex
                        ? (@preg_match($grepStr, $line) === 1)
                        : ($noCase ? stripos($line,$grepStr)!==false : strpos($line,$grepStr)!==false);
                    if ($hit) $lines[] = ['line'=>$ln,'text'=>rtrim($line)];
                }
                fclose($handle);
                if ($lines) $results[$f['name']] = $lines;
            }
        }
        return ['results' => $results, 'total' => count($results), 'error' => $error];
    }
}

/**
 * GrappaCheckArt · ART-Konsistenzprüfung HTML+PHP ↔ JSON
 */
class GrappaCheckArt {
    public static function extractArtNr(string $absPath): ?string {
        $content = @file_get_contents($absPath);
        if ($content === false) return null;
        if (preg_match("/'art_nr'\s*=>\s*'(ART-\d{4}-\d{4}-\d{6}\.\d{4})'/", $content, $m)) return $m[1];
        if (preg_match('/["\']?art_nr["\']?\s*:\s*["\']?(ART-\d{4}-\d{4}-\d{6}\.\d{4})["\']?/', $content, $m)) return $m[1];
        if (preg_match('/["\']?(ART-\d{4}-\d{4}-\d{6}\.\d{4})["\']?/', $content, $m)) return $m[1];
        return null;
    }

    public static function extractVersion(string $name): array {
        if (preg_match('/_v(\d+)[\._](\d+)\.[a-z]+$/i', $name, $m))
            return [(int)$m[1], (int)$m[2]];
        return [0, 0];
    }

    public static function run(string $dir): array {
        $scanItems = @scandir($dir) ?: [];
        $candidates = [];
        foreach ($scanItems as $item) {
            $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
            if (!in_array($ext, ['html','php'], true)) continue;
            if (preg_match('/^(.+?)(_v\d+[\._]\d+)?\.'.$ext.'$/i', $item, $m))
                $base = strtolower($m[1].'.'.$ext);
            else $base = strtolower($item);
            $ver = self::extractVersion($item);
            if (!isset($candidates[$base])) {
                $candidates[$base] = ['name'=>$item,'ver'=>$ver];
            } else {
                $cur = $candidates[$base]['ver'];
                if ($ver[0] > $cur[0] || ($ver[0]===$cur[0] && $ver[1]>$cur[1]))
                    $candidates[$base] = ['name'=>$item,'ver'=>$ver];
            }
        }
        $results = [];
        foreach ($candidates as $info) {
            $abs   = $dir.DIRECTORY_SEPARATOR.$info['name'];
            $artNr = self::extractArtNr($abs);
            if ($artNr === null) continue;
            $jf  = $dir.DIRECTORY_SEPARATOR.$artNr.'.json';
            $jok = file_exists($jf);
            $jArt = $jKey = $jVer = null;
            if ($jok) {
                $raw = @file_get_contents($jf);
                $d   = $raw !== false ? (json_decode($raw,true) ?? []) : [];
                $jArt = $d['art'] ?? null;
                $jKey = $d['key'] ?? null; // Legacy · OP-54
                $jVer = $d['artikel_version'] ?? null;
            }
            $klasse = !$jok ? 'no_json'
                    : (($jArt===$artNr||$jKey===$artNr) ? 'ok' : 'drift');
            $results[] = [
                'datei'=>$info['name'],'art_nr_iv'=>$artNr,
                'json_datei'=>$artNr.'.json','json_exists'=>$jok,
                'json_art'=>$jArt,'json_version'=>$jVer,'klasse'=>$klasse,
            ];
        }
        usort($results, fn($a,$b) => (['drift'=>0,'no_json'=>1,'ok'=>2][$a['klasse']]??9) <=> (['drift'=>0,'no_json'=>1,'ok'=>2][$b['klasse']]??9));
        return $results;
    }
}

/**
 * GrappaExport · JSON-Export · merge-fähig · Rollback by design
 * Dateiname: UTC_HOST_PATH.json · kollisionsfrei · grepbar
 */
class GrappaExport {
    /**
     * Exportiert Scan-Ergebnis als JSON
     * Dateiname: YYYYMMDDTHHMMSS_mmm_HOST_PATH.json
     */
    public static function exportScan(
        string $dir,
        array $files,
        array $grepResults,
        string $host,
        string $path,
        string $pattern,
        string $grepStr,
        string $artVersion
    ): array {
        $now = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $ms  = sprintf('%03d', (int)(microtime(true) * 1000) % 1000);
        $utc = $now->format('Ymd\THis').'.'.$ms;

        // Dateiname: UTC_HOST_PATH.json · kollisionsfrei
        $hostSafe = preg_replace('/[^a-zA-Z0-9]/', '_', $host);
        $pathSafe = preg_replace('/[^a-zA-Z0-9]/', '_', trim($path, '/')) ?: 'root';
        $outName  = $utc.'_'.$hostSafe.'_'.$pathSafe.'.json';
        $outFile  = $dir.DIRECTORY_SEPARATOR.$outName;

        // BAK des letzten Exports (Rollback by design)
        $lastExport = $dir.DIRECTORY_SEPARATOR.'.last_export.json';
        if (file_exists($lastExport)) {
            @copy($lastExport, $lastExport.'.bak');
        }

        $payload = [
            'schema'          => 'grappa-scan-export-v01.00',
            'utc_iso'         => $now->format('c'),
            'utc_ms'          => $utc,
            'host'            => $host,
            'path'            => $path,
            'generated_by'    => 'BRUTALSUCHE_File.php · '.$artVersion,
            'pattern'         => $pattern,
            'grep'            => $grepStr,
            'datei_count'     => count($files),
            'grep_hits'       => count($grepResults),
            // Rollback-Info
            'rollback'        => 'BAK: .last_export.json.bak · manuell umbenennen',
            'merge_key'       => 'utc_ms|host|path',  // für Konsolidierung
            'dateien'         => array_map(fn($f) => [
                'name'  => $f['name'],
                'size'  => $f['size'] ?? 0,
                'mtime' => isset($f['mtime']) ? date('c', $f['mtime']) : null,
                'ext'   => $f['ext'] ?? pathinfo($f['name'], PATHINFO_EXTENSION),
            ], $files),
            'grep_ergebnisse' => $grepResults,
        ];

        $written = file_put_contents(
            $outFile,
            json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            LOCK_EX
        );

        // Symlink auf letzten Export
        @file_put_contents($lastExport, json_encode(['letzte_datei'=>$outName,'utc'=>$utc]), LOCK_EX);

        return [
            'success'   => $written !== false,
            'datei'     => $outName,
            'utc'       => $utc,
            'merge_key' => $utc.'|'.$host.'|'.$path,
        ];
    }
}

/**
 * GrappaUrl · URL-Parameter-Handling · Sonderzeichen-sicher
 * Regex-Patterns enthalten /, \, (, ), | → müssen korrekt enkodiert werden
 */
class GrappaUrl {
    /**
     * URL für lsfilter mit aktuellem Pattern als q1-Parameter
     * Sonderzeichen werden durch http_build_query korrekt enkodiert
     */
    public static function lsfilterUrl(
        string $lsfilterBase,
        string $pattern,
        string $grep = '',
        string $mode = 'regex'
    ): string {
        $params = ['mode' => $mode];
        if ($pattern !== '') $params['q1'] = $pattern;
        if ($grep !== '')    $params['q2'] = $grep;
        // http_build_query verwendet urlencode() — korrekt für Sonderzeichen
        return $lsfilterBase . '?' . http_build_query($params);
    }

    /**
     * BRUTALSUCHE-URL mit vorausgefüllten Parametern
     * Für Favoriten/Links mit gespeicherten Suchzuständen
     */
    public static function buildUrl(array $params): string {
        return '?' . http_build_query(array_filter($params, fn($v) => $v !== '' && $v !== null && $v !== false));
    }

    public static function nextDir(string $col, string $cs, string $cd): string {
        return ($cs === $col) ? (($cd === 'asc') ? 'desc' : 'asc') : 'asc';
    }
}

// ── Helper-Funktionen (prozedural · Abwärtskompatibilität) ───────
function buildUrl(array $params): string { return GrappaUrl::buildUrl($params); }
function nextDir(string $col, string $cs, string $cd): string { return GrappaUrl::nextDir($col,$cs,$cd); }
function headerLink(string $label, string $col, string $cs, string $cd, array $bp): string {
    $isActive = ($cs === $col);
    $arrow = $isActive ? ($cd==='asc'?' <span class="arrow-active">▲</span>'
                                    :'<span class="arrow-active">▼</span>') : '';
    $cls = 'th-link '.($isActive?'active':'inactive');
    $url = buildUrl(array_merge($bp,['sort'=>$col,'dir'=>GrappaUrl::nextDir($col,$cs,$cd)]));
    return '<a class="'.$cls.'" href="'.htmlspecialchars($url).'">'.htmlspecialchars($label).$arrow.'</a>';
}
function colorClass(string $ext): string {
    return in_array($ext,['htm','html','php'],true)?'light-green':'dark-green';
}

// ── GRAPPA-Funktionen ─────────────────────────────────────────────
function generateArtNr(): string {
    $mt = microtime(true);
    $micro = sprintf('%04d',(int)(($mt-floor($mt))*10000));
    $d = DateTimeImmutable::createFromFormat('U.u',number_format($mt,6,'.',))
           ->setTimezone(new DateTimeZone('UTC'));
    return sprintf('ART-%s-%s%s-%s%s%s.%s',$d->format('Y'),$d->format('m'),$d->format('d'),
                   $d->format('H'),$d->format('i'),$d->format('s'),$micro);
}

function rotateBackups(string $file, int $limit): void {
    for ($i=$limit-1;$i>=1;$i--) {
        $old=$file.($i>1?'.BAK.'.($i-1):'.BAK');$new=$file.'.BAK.'.$i;
        if(file_exists($old)) rename($old,$new);
    }
    rename($file,$file.'.BAK');
}


function buildGrappaArtifact(): array {
    $iv     = importantValues();
    $artNr  = $iv['art_nr'];
    $jf     = $artNr.'.json';
    $ex     = [];
    if (file_exists($jf)) { $raw=file_get_contents($jf); if($raw) $ex=json_decode($raw,true)??[]; }
    $merged = array_replace_recursive($ex, $iv);
    if (!empty($ex['art_nr'])) $merged['art_nr'] = $ex['art_nr'];
    // OP-54: nur 'art' · 'key' entfernt
    $merged['art'] = $merged['art_nr'];
    unset($merged['key']); // OP-54: Legacy entfernen
    if (empty($merged['schema'])) $merged['schema'] = 'GRAPPA-Artikel v08.00';
    if (empty($merged['slug']))   $merged['slug']   = isset($iv['datei_php']) ? pathinfo($iv['datei_php'],PATHINFO_FILENAME) : '';
    $merged['last_modified'] = (new DateTimeImmutable('now',new DateTimeZone('UTC')))->format('c');
    if (file_exists($jf)) rotateBackups($jf,$iv['index_generator']['bak_rotation_limit']);
    $written = file_put_contents($jf,json_encode($merged,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),LOCK_EX);
    return ['success'=>$written!==false,'json_file'=>$jf,'art_nr'=>$merged['art_nr'],'version'=>$merged['artikel_version']];
}

function slugFromTitel(string $titel): string {
    $s = mb_strtolower($titel,'UTF-8');
    $s = str_replace(['ä','ö','ü','ß','Ä','Ö','Ü'],['ae','oe','ue','ss','ae','oe','ue'],$s);
    return trim(preg_replace('/[^a-z0-9]+/','_',$s),'_');
}

function buildIndexGeneratorData(string $dir, int $bakLimit): array {
    $items = []; $scan = @scandir($dir)?:[];
    foreach ($scan as $item) {
        if (preg_match('/_v\d{2}[\._]\d{2}\.(html|php|md|json)$/i',$item)) continue;
        if (!preg_match('/^(ART-\d{4}-\d{4}-\d{6}\.\d{4})\.json$/',$item,$m)) continue;
        $abs = $dir.DIRECTORY_SEPARATOR.$item;
        $raw = @file_get_contents($abs); if(!$raw) continue;
        $d   = json_decode($raw,true); if(!is_array($d)) continue;
        $items[] = ['art'=>$m[1],'datei'=>$item,'last_modified'=>$d['last_modified']??'',
                    'titel'=>$d['titel']??'','artikel_version'=>$d['artikel_version']??'',
                    'framework_version'=>$d['framework_version']??'','status'=>$d['status']??'aktiv',
                    'slug'=>$d['slug']??'','datei_html'=>$d['datei_html']??'',
                    'datei_php'=>$d['datei_php']??'','flags'=>$d['flags']??[]];
    }
    usort($items,fn($a,$b)=>strcmp($b['last_modified'],$a['last_modified']));
    return $items;
}

function writeGrappaArtikelJson(string $dir, array $data, int $lim): array {
    $f = $dir.DIRECTORY_SEPARATOR.'Grappa_artikel.json';
    $iv = importantValues();
    $p  = ['schema'=>'GRAPPA-Artikel-Register v08.01',
           'generated_by'=>'BRUTALSUCHE_File.php · '.$iv['artikel_version'],
           'generated_at'=>(new DateTimeImmutable('now',new DateTimeZone('UTC')))->format('c'),
           'count'=>count($data),'objekte'=>$data];
    if (file_exists($f)) rotateBackups($f,$lim);
    $w = file_put_contents($f,json_encode($p,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),LOCK_EX);
    return ['success'=>$w!==false,'file'=>'Grappa_artikel.json','count'=>count($data)];
}

// ── Action-Handler ────────────────────────────────────────────────
$action = $_GET['action'] ?? '';
$actionResult = null;
if ($action==='build_artifact')  $actionResult = buildGrappaArtifact();
if ($action==='generate_art_nr') $actionResult = ['new_art_nr'=>generateArtNr()];
if ($action==='slug_vorschlag') {
    $slug = slugFromTitel($_GET['titel']??'');
    $actionResult = ['vorschlag'=>$slug.'.'.($_GET['ext']??'html'),
                     'hinweis'=>'PO prüft ob Datei auf Host existiert'];
}

// ── Directory Setup ───────────────────────────────────────────────
$docRoot     = realpath($_SERVER['DOCUMENT_ROOT'] ?? '.');
if ($docRoot === false) $docRoot = __DIR__;
$rawSubdir   = $_GET['subdir'] ?? '.';
$reqAbs      = realpath($rawSubdir);
if ($reqAbs===false) $reqAbs=$docRoot;
if (!str_starts_with($reqAbs.DIRECTORY_SEPARATOR, $docRoot.DIRECTORY_SEPARATOR) && $reqAbs!==$docRoot)
    $reqAbs=$docRoot;
$currentAbs = $reqAbs;
$relDisplay = ($currentAbs===$docRoot) ? './' : './'.ltrim(str_replace($docRoot,'',$currentAbs),DIRECTORY_SEPARATOR);
$parentAbs  = realpath($currentAbs.DIRECTORY_SEPARATOR.'..');
$hasParent  = ($parentAbs!==false && $parentAbs!==$currentAbs
    && str_starts_with($parentAbs.DIRECTORY_SEPARATOR,$docRoot.DIRECTORY_SEPARATOR));

// ── File Scanning ─────────────────────────────────────────────────
$fileInfo = []; $subdirs = [];
foreach (@scandir($currentAbs)?:[] as $item) {
    if ($item==='.'||$item==='..') continue;
    $abs = $currentAbs.DIRECTORY_SEPARATOR.$item;
    if (is_dir($abs)) { $subdirs[]=$item; continue; }
    $fileInfo[] = ['name'=>$item,'ctime'=>(int)@filectime($abs),'mtime'=>(int)@filemtime($abs),
                   'size'=>(int)@filesize($abs),'ext'=>strtolower(pathinfo($item,PATHINFO_EXTENSION)),
                   'hidden'=>($item[0]==='.')];
}
sort($subdirs);

// ── Parameter ─────────────────────────────────────────────────────
$pattern      = $_GET['pattern']  ?? '';
$sort         = $_GET['sort']     ?? 'mtime';
$dirSort      = $_GET['dir']      ?? 'desc';
$useRegex     = in_array($_GET['regex']??'0',['1','y','j'],true);
$filterNoCase = ($_GET['fnc']??'1') === '1';
$grepStr      = $_GET['grep']     ?? '';
$grepNoCase   = ($_GET['gnc']??'1') === '1';
$grepWholeFile= ($_GET['gwf']??'0') === '1';
$keyList      = $_GET['keylist']  ?? '';

// Auto-Regex aus Key-Liste
$autoGeneratedRegex = '';
if ($keyList !== '' && $grepStr === '') {
    $autoGeneratedRegex = GrappaGrep::autoRegexFromKeys($keyList);
    $grepStr = $autoGeneratedRegex;
}

// check_art
$checkArtResults = null;
if ($action === 'check_art') $checkArtResults = GrappaCheckArt::run($currentAbs);

// export_scan
if ($action === 'export_scan') {
    $host = $_SERVER['HTTP_HOST'] ?? 'unknown';
    $actionResult = GrappaExport::exportScan(
        $currentAbs, $fileInfo, [], $host, $relDisplay,
        $pattern, $grepStr, $iv['artikel_version']
    );
    $actionResult['type'] = 'export_scan';
}

// build_index
if ($action === 'build_index') {
    $idxData = buildIndexGeneratorData($currentAbs,$iv['index_generator']['bak_rotation_limit']);
    $actionResult = writeGrappaArtikelJson($currentAbs,$idxData,$iv['index_generator']['bak_rotation_limit']);
    $actionResult['type'] = 'build_index';
}

// ── Filtern ───────────────────────────────────────────────────────
$filterResult = GrappaSearch::filter($fileInfo, $pattern, $useRegex, $filterNoCase);
$filteredFiles = $filterResult['files'];
$patternError  = $filterResult['error'];

// ── Grep ──────────────────────────────────────────────────────────
$grepResult = ['results'=>[],'total'=>0,'error'=>''];
if ($grepStr !== '') {
    $isGrepRegex = ($autoGeneratedRegex !== '') || GrappaGrep::isRegex($grepStr);
    if ($isGrepRegex && $autoGeneratedRegex === '') {
        // Grep als Regex
        $grepResult = GrappaGrep::run($filteredFiles,$currentAbs,$grepStr,true,$grepNoCase,$grepWholeFile);
    } else {
        $grepResult = GrappaGrep::run($filteredFiles,$currentAbs,$grepStr,false,$grepNoCase,$grepWholeFile);
    }
}
$grepResults  = $grepResult['results'];
$totalGrepped = $grepResult['total'];
$grepError    = $grepResult['error'];

// ── Sortierung ────────────────────────────────────────────────────
$sortedFiles = array_values($filteredFiles);
usort($sortedFiles,function($a,$b)use($sort,$dirSort){
    $cmp=match($sort){'name'=>strcasecmp($a['name'],$b['name']),'ctime'=>$a['ctime']<=>$b['ctime'],default=>$a['mtime']<=>$b['mtime']};
    return $dirSort==='asc'?$cmp:-$cmp;
});
$totalFiles = count($sortedFiles);

// ── Base Params ───────────────────────────────────────────────────
$baseParams = [
    'pattern'=>$pattern,'regex'=>$useRegex?'1':'0','fnc'=>$filterNoCase?'1':'0',
    'grep'=>($grepStr===$autoGeneratedRegex)?'':$grepStr,
    'gnc'=>$grepNoCase?'1':'0','gwf'=>$grepWholeFile?'1':'0',
    'keylist'=>$keyList,'subdir'=>$relDisplay,'sort'=>$sort,'dir'=>$dirSort,
];

// ART-Nr Index
$artNrIndex = GrappaSearch::artIndex($sortedFiles);

// lsfilter-URL vorbereiten
$lsfilterBase = './lsfilter.php';
$lsfilterUrl  = GrappaUrl::lsfilterUrl($lsfilterBase, $pattern, $grepStr);

?>
<!DOCTYPE html>
<!-- ═══════════════════════════════════════════════════════════
     GRAPPA FREE FRAMEWORK · ART:<?= $iv['art_nr'] ?>
     BRUTALSUCHE_File · <?= $iv['artikel_version'] ?> · <?= $iv['framework_version'] ?>
     GGSTC: <?= $ggstc_static ?>
     "To boldly go where no framework has gone before." 🖖
     Copyright (C) 2026 rcpffm · AGPL-3.0
═══════════════════════════════════════════════════════════ -->
<html lang="<?= htmlspecialchars($iv['sprache']) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots"  content="noindex, nofollow">
<link rel="license"  href="<?= htmlspecialchars($iv['lizenz_url']) ?>">
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🥃</text></svg>">
<title><?= htmlspecialchars($iv['titel']) ?> · <?= htmlspecialchars($iv['artikel_version']) ?></title>
<meta id="meta-desc" name="description"        content="">
<meta id="meta-kw"   name="keywords"           content="">
<meta property="og:type"                       content="website">
<meta property="og:title"                      content="">
<meta property="og:description"                content="">
<style>
  *,*::before,*::after{box-sizing:border-box}
  body{font-family:system-ui,-apple-system,BlinkMacSystemFont,sans-serif;
       background:#1a1a2e;color:#e0e0e0;margin:0;padding:12px;font-size:16px;line-height:1.5}
  .container{max-width:960px;margin:auto}
  .grappa-badge{font-family:ui-monospace,'Courier New',monospace;font-size:.72rem;color:#e8c87a;
    letter-spacing:.15em;text-transform:uppercase;margin-bottom:.5rem;opacity:.8}
  .art-nr{color:#f0ede8}
  #grappa-drift-banner{display:none;background:#8b0000;border-bottom:2px solid #e8242a;
    padding:.6rem 1rem;font-family:ui-monospace,monospace;font-size:.78rem;color:#fff;
    margin-bottom:.5rem;animation:grappa-drift-blink 1.4s step-start infinite}
  @keyframes grappa-drift-blink{0%,100%{opacity:1}50%{opacity:.35}}
  .ggstc-bar{display:inline-flex;align-items:center;gap:.4em;font-family:ui-monospace,monospace;
    font-size:.78em;margin-left:12px;vertical-align:middle}
  #ggstc-label{color:#4a9eff}
  #ggstc-display{color:#f39c12;min-width:9ch;display:inline-block}
  #ggstc-mode{font-size:.78em;margin-left:4px;display:none}
  #ggstc-mode.js-mode{display:inline;color:#ff4444;font-style:italic}
  #ggstc-mode.py-mode{display:inline;color:#44cc44;font-style:italic}
  .ggstc-dot{display:inline-block;width:5px;height:5px;border-radius:50%;background:#f39c12;
    animation:ggstc-pulse 10s ease-in-out infinite}
  @keyframes ggstc-pulse{0%,100%{opacity:.4;transform:scale(1)}50%{opacity:1;transform:scale(1.5)}}
  #version-display{font-family:ui-monospace,monospace;font-size:.78rem;color:#4a9eff;
    text-decoration:underline;cursor:pointer;user-select:none;margin-left:8px;vertical-align:middle}
  h1{color:#ff6b6b;margin:0 0 2px;font-size:1.4em;display:inline}
  h4{color:#aaa;margin:0 0 10px;font-size:.85em}
  .action-box{background:#0d2137;border:1px solid #4a9eff;border-radius:6px;padding:1rem;
    margin:.75rem 0;font-family:ui-monospace,monospace;font-size:.85rem}
  .action-box .art-highlight{font-size:1.1rem;color:#e8c87a;font-weight:bold;display:block;margin:.5rem 0}
  .action-box.success{border-color:#059669}.action-box.warning{border-color:#f39c12}
  .search-form{background:#16213e;border:1px solid #333;border-radius:6px;padding:12px;margin-bottom:12px}
  .form-row{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:8px;align-items:center}
  input[type=text],textarea{background:#0f3460;color:#e0e0e0;border:1px solid #444;border-radius:4px;
    padding:6px 10px;font-family:ui-monospace,monospace;font-size:.85rem}
  textarea{resize:vertical;min-height:60px;width:100%}
  input[type=text]{flex:1;min-width:120px}
  button{background:#0f3460;color:#e0e0e0;border:1px solid #444;border-radius:4px;padding:6px 14px;
    cursor:pointer;font-size:.85rem;transition:background .2s}
  button:hover{background:#1a4a7a}
  button.primary{background:#059669;border-color:#047857}
  button.primary:hover{background:#047857}
  button.danger{background:#8b0000;border-color:#600}
  button.lsfilter{background:#1a3a6a;border-color:#4a9eff;color:#4a9eff}
  button.lsfilter:hover{background:#2a4a8a}
  .pill-wrap{display:inline-flex;align-items:center;gap:4px}
  .toggle-pill{display:inline-flex;align-items:center;gap:6px;background:#0f3460;border:1px solid #444;
    border-radius:20px;padding:4px 12px;cursor:pointer;font-size:.82rem;transition:background .2s;user-select:none}
  .toggle-pill.active{background:#0a5c3a;border-color:#059669;color:#4ade80}
  .toggle-pill input[type=checkbox]{display:none}
  .key-liste-wrap{margin-bottom:8px}
  .key-liste-label{font-size:.8rem;color:#aaa;margin-bottom:4px}
  table{width:100%;border-collapse:collapse;margin-top:8px}
  th,td{text-align:left;padding:5px 8px;font-size:.82rem;border-bottom:1px solid #2a2a4a}
  th{background:#16213e;color:#aaa}
  tr:hover td{background:rgba(74,158,255,.05)}
  .light-green{color:#90ee90}.dark-green{color:#3cb371}
  .th-link{color:#aaa;text-decoration:none}.th-link:hover{color:#4a9eff}.th-link.active{color:#4a9eff}
  .arrow-active{color:#4a9eff}
  .grep-result{background:#0d2137;border-left:3px solid #4a9eff;margin:4px 0;padding:6px 10px;
    font-family:ui-monospace,monospace;font-size:.78rem}
  .grep-filename{color:#4a9eff;font-weight:bold;margin-bottom:4px}
  .grep-line{color:#aaa}.grep-text{color:#e0e0e0;white-space:pre-wrap;word-break:break-all}
  .art-index-box{background:#0d2137;border:1px solid #333;border-radius:4px;
    padding:8px 12px;margin:8px 0;font-family:ui-monospace,monospace;font-size:.78rem}
  .art-item-link{color:#e8c87a;text-decoration:underline;display:block;padding:2px 0}
  .art-item-link:hover{color:#fff}
  .index-generator-box{background:#16213e;border:1px solid #4a9eff;border-radius:6px;
    padding:1rem;margin:.75rem 0;font-size:.85rem}
  .index-generator-box h3{color:#e8c87a;margin:0 0 .6rem;font-size:1rem}
  .ig-info{color:#888;font-size:.78rem;margin-top:.5rem;font-family:ui-monospace,monospace}
  .ig-warn{color:#f39c12;font-size:.78rem;margin-top:.4rem}
  a.companion-link{color:#4a9eff;text-decoration:underline}
  .stats{font-size:.8rem;color:#aaa;margin:6px 0}.stats strong{color:#e0e0e0}
  .check-art-box{background:#0d2137;border:1px solid #4a9eff;border-radius:6px;padding:1rem;margin:.75rem 0;font-size:.83rem}
  .check-art-box h3{color:#e8c87a;margin:0 0 .6rem;font-size:1rem}
  .check-art-table{width:100%;border-collapse:collapse;margin-top:.5rem}
  .check-art-table th{background:#16213e;color:#aaa;text-align:left;padding:5px 8px;font-size:.78rem;border-bottom:1px solid #2a2a4a}
  .check-art-table td{padding:5px 8px;font-size:.78rem;border-bottom:1px solid #1a1a3a;font-family:ui-monospace,monospace}
  .ca-ok{color:#4ade80}.ca-drift{color:#ff6b6b}.ca-nojson{color:#f39c12}
  .site-footer{margin-top:2rem;border-top:1px solid #2a2a4a;padding-top:1rem;font-size:.78rem;color:#555}
  /* lsfilter-Bridge Banner */
  .lsfilter-bridge{background:#0d2137;border:1px solid #4a9eff;border-radius:4px;
    padding:6px 10px;margin:6px 0;font-size:.78rem;font-family:ui-monospace,monospace;
    display:flex;align-items:center;gap:8px;flex-wrap:wrap}
  .lsfilter-bridge a{color:#4a9eff}
</style>
</head>
<body>
<div class="container">

<div id="grappa-drift-banner">
  ⚠ GRAPPA DRIFT DETECTED · <span id="grappa-drift-details"></span>
</div>

<div class="grappa-badge">
  GRAPPA FREE FRAMEWORK · <span class="art-nr"><?= htmlspecialchars($iv['art_nr']) ?></span>
  <span id="version-display"><?= htmlspecialchars($iv['artikel_version']) ?></span>
  <span class="ggstc-bar">
    <span class="ggstc-dot"></span>
    <span id="ggstc-label">GGSTC</span>
    <span id="ggstc-display"><?= htmlspecialchars($ggstc_static) ?></span>
    <span id="ggstc-mode"></span>
  </span>
</div>

<h1>🥃 BRUTALSUCHE_File</h1>
<h4><?= htmlspecialchars($iv['subtitle']) ?></h4>

<?php if ($actionResult): ?>
<div class="action-box <?= ($actionResult['success']??true)?'success':'warning' ?>">
  <?php if (($actionResult['type']??'') === 'export_scan'): ?>
    <strong>📤 Export:</strong>
    <span class="art-highlight"><?= htmlspecialchars($actionResult['datei']) ?></span>
    Merge-Key: <?= htmlspecialchars($actionResult['merge_key']) ?> ·
    Rollback: .last_export.json.bak
  <?php elseif (($actionResult['type']??'') === 'build_index'): ?>
    <strong>📋 Index:</strong> Grappa_artikel.json · <?= (int)($actionResult['count']??0) ?> Einträge
  <?php elseif (isset($actionResult['new_art_nr'])): ?>
    <strong>🆕 Neue ART-Nr:</strong>
    <span class="art-highlight"><?= htmlspecialchars($actionResult['new_art_nr']) ?></span>
  <?php else: ?>
    <strong>✅ Erledigt:</strong> <?= htmlspecialchars(json_encode($actionResult,JSON_UNESCAPED_UNICODE)) ?>
  <?php endif ?>
</div>
<?php endif ?>

<!-- ── FORM ── -->
<form class="search-form" id="mainform" method="GET">
  <input type="hidden" name="subdir" value="<?= htmlspecialchars($relDisplay) ?>">

  <!-- Verzeichnis -->
  <div class="form-row" style="font-size:.82rem;color:#aaa;font-family:ui-monospace,monospace">
    📁 <?= htmlspecialchars($relDisplay) ?>
    <?php if($hasParent):?>
    · <a class="companion-link" href="?subdir=<?= urlencode(dirname($relDisplay)) ?>">⬆ hoch</a>
    <?php endif?>
    <?php foreach($subdirs as $sd):?>
    · <a class="companion-link" href="?subdir=<?= urlencode($relDisplay.$sd) ?>"><?= htmlspecialchars($sd) ?>/</a>
    <?php endforeach?>
  </div>

  <!-- Filter-Pattern -->
  <div class="form-row">
    <input type="text" id="patternInput" name="pattern"
           value="<?= htmlspecialchars($pattern) ?>"
           placeholder="Dateiname: *.html *.php  oder  Regex: \.(html|php)$">
    <label class="pill-wrap">
      <label class="toggle-pill" id="pill-regex" for="regex">
        <input type="checkbox" id="regex" name="regex" value="1" <?= $useRegex?'checked':''?>>
        Regex ☑
      </label>
    </label>
    <label class="toggle-pill" id="pill-fnc" for="fnc">
      <input type="checkbox" id="fnc" name="fnc" value="1" <?= $filterNoCase?'checked':''?>>
      GK-egal
    </label>
  </div>

  <!-- Schnellwahl Pattern -->
  <div class="form-row" style="gap:4px;flex-wrap:wrap">
    <span style="font-size:.75rem;color:#555">Schnell:</span>
    <button type="button" onclick="setPattern('*.html *.php',false)">html+php</button>
    <button type="button" onclick="setPattern('*.html',false)">html</button>
    <button type="button" onclick="setPattern('*.php',false)">php</button>
    <button type="button" onclick="setPattern('*.json',false)">json</button>
    <button type="button" onclick="setPattern('.*',true)">\.(html?|php|json|md)$</button>
    <button type="button" onclick="setPattern('',false)">alle GRAPPA</button>
  </div>

  <!-- Grep -->
  <div class="form-row">
    <input type="text" id="grepInput" name="grep"
           value="<?= htmlspecialchars(($grepStr===$autoGeneratedRegex)?'':(string)$grepStr) ?>"
           placeholder="Grep: Text  oder  /Regex/  oder  /(Lao|Hegel)/">
    <label class="toggle-pill" id="pill-gnc" for="gnc">
      <input type="checkbox" id="gnc" name="gnc" value="1" <?= $grepNoCase?'checked':''?>>
      GK-egal
    </label>
    <label class="toggle-pill" id="pill-gwf" for="gwf">
      <input type="checkbox" id="gwf" name="gwf" value="1" <?= $grepWholeFile?'checked':''?>>
      Ganzdatei
    </label>
  </div>

  <!-- Key-Liste -->
  <div class="key-liste-wrap">
    <div class="key-liste-label">Key-Liste (Auto-Grep · eine Zeile pro Key):</div>
    <textarea id="keyListInput" name="keylist" rows="3"
              placeholder="slug&#10;artikel_version&#10;titel"><?= htmlspecialchars($keyList) ?></textarea>
  </div>

  <div class="form-row">
    <button type="submit" class="primary">🔍 Suchen</button>
    <button type="button" onclick="lsSave()">💾 LS speichern</button>
    <button type="button" onclick="lsLoad()">📂 LS laden</button>
    <button type="button" class="danger" onclick="lsDel()">🗑 LS löschen</button>
    <span id="ls-info" style="font-size:.75rem;color:#555;font-family:ui-monospace,monospace"></span>
  </div>
</form>

<!-- ── lsfilter-Bridge ── -->
<?php if ($pattern !== '' || $grepStr !== ''): ?>
<div class="lsfilter-bridge">
  <span>🔗 lsfilter:</span>
  <a href="<?= htmlspecialchars(GrappaUrl::lsfilterUrl('./lsfilter.php',$pattern,$grepStr)) ?>"
     target="_blank">
    Mit aktuellem Pattern in lsfilter öffnen
  </a>
  <span style="color:#555">· q1=Pattern · q2=Grep · Sonderzeichen korrekt enkodiert</span>
</div>
<?php endif?>

<?php if ($patternError): ?>
<div style="background:#4a1a1a;border:1px solid #ff6b6b;border-radius:4px;padding:8px;margin:6px 0;font-family:ui-monospace,monospace;font-size:.82rem;color:#ff6b6b">
  ⚠ <?= htmlspecialchars($patternError) ?>
</div>
<?php endif?>
<?php if ($grepError): ?>
<div style="background:#4a3a1a;border:1px solid #f39c12;border-radius:4px;padding:8px;margin:6px 0;font-family:ui-monospace,monospace;font-size:.82rem;color:#f39c12">
  ⚠ <?= htmlspecialchars($grepError) ?>
</div>
<?php endif?>

<div class="stats">
  Verzeichnis: <strong><?= htmlspecialchars($relDisplay) ?></strong> ·
  Dateien: <strong><?= $totalFiles ?></strong>
  <?php if ($grepStr && !$grepError): ?> · Grep-Treffer: <strong><?= $totalGrepped ?></strong><?php endif?>
</div>

<!-- ── ART-Nr Index ── -->
<?php if ($artNrIndex): ?>
<div class="art-index-box">
  <strong style="color:#e8c87a">ART-Keys (<?= count($artNrIndex) ?>):</strong>
  <?php foreach($artNrIndex as $art): ?>
  <a class="art-item-link"
     href="./GRAPPABRUTAL_JSON_SmartFilter_Editor.php?JsonPfadName=<?= urlencode($art.'.json') ?>"
     title="SmartFilter: <?= htmlspecialchars($art) ?>">
    🔑 <?= htmlspecialchars($art) ?>
  </a>
  <?php endforeach?>
</div>
<?php endif?>

<!-- ── Ergebnistabelle ── -->
<?php if (!$grepStr || $grepError): ?>
<table>
  <thead>
    <tr>
      <th><?= headerLink('Dateiname','name',$sort,$dirSort,$baseParams) ?></th>
      <th><?= headerLink('mtime','mtime',$sort,$dirSort,$baseParams) ?></th>
      <th><?= headerLink('ctime','ctime',$sort,$dirSort,$baseParams) ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($sortedFiles as $f):
    $cls=colorClass($f['ext']);
    $url='./'.($relDisplay==='./' ? '' : ltrim($relDisplay,'./')).rawurlencode($f['name']);
  ?>
  <tr>
    <td class="<?=$cls?>">
      <a href="javascript:void(0)"
         onclick="openFile('<?= addslashes($url) ?>','<?= addslashes($f['name']) ?>')"
         style="color:inherit;text-decoration:none">
        <?= htmlspecialchars($f['name']) ?>
      </a>
    </td>
    <td style="font-size:.78rem;color:#888;white-space:nowrap;font-family:ui-monospace,monospace">
      <?= date('Y-m-d H:i',$f['mtime']) ?>
    </td>
    <td style="font-size:.78rem;color:#555;white-space:nowrap;font-family:ui-monospace,monospace">
      <?= date('Y-m-d H:i',$f['ctime']) ?>
    </td>
  </tr>
  <?php endforeach?>
  <?php if(empty($sortedFiles)):?>
  <tr><td colspan="3" style="color:#555;padding:20px;text-align:center">Keine Dateien gefunden.</td></tr>
  <?php endif?>
  </tbody>
</table>
<?php endif?>

<!-- ── Grep-Ergebnisse ── -->
<?php if ($grepResults): ?>
<div style="margin-top:12px">
  <strong style="color:#4a9eff">Grep-Ergebnisse (<?= $totalGrepped ?> Dateien):</strong>
  <?php foreach($grepResults as $fname=>$lines):?>
  <div class="grep-result">
    <div class="grep-filename">📄 <?= htmlspecialchars($fname) ?></div>
    <?php foreach(array_slice($lines,0,20) as $l):?>
    <div>
      <?php if($l['line']>0):?><span class="grep-line"><?= $l['line'] ?>:</span><?php endif?>
      <span class="grep-text"><?= htmlspecialchars(substr($l['text'],0,200)) ?></span>
    </div>
    <?php endforeach?>
    <?php if(count($lines)>20):?><div style="color:#555">… +<?= count($lines)-20 ?> weitere</div><?php endif?>
  </div>
  <?php endforeach?>
</div>
<?php endif?>

<!-- ── check_art Ergebnis ── -->
<?php if ($checkArtResults !== null): ?>
<div class="check-art-box">
  <h3>🔬 ART-Konsistenz · <?= count($checkArtResults) ?> Dateien geprüft</h3>
  <table class="check-art-table">
    <thead><tr><th>Datei</th><th>ART-Nr (IV)</th><th>JSON</th><th>Version</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach($checkArtResults as $r):
      $cls=['ok'=>'ca-ok','drift'=>'ca-drift','no_json'=>'ca-nojson'][$r['klasse']]??'';
      $icon=['ok'=>'✅','drift'=>'❌','no_json'=>'⚠'][$r['klasse']]??'?';
    ?>
    <tr>
      <td><a href="./<?= urlencode($r['datei']) ?>" target="_blank" style="color:#4a9eff"><?= htmlspecialchars($r['datei']) ?></a></td>
      <td><?= htmlspecialchars($r['art_nr_iv']??'—') ?></td>
      <td><?php if($r['json_exists']):?>
        <a href="./GRAPPABRUTAL_JSON_SmartFilter_Editor.php?JsonPfadName=<?= urlencode($r['json_datei']) ?>" style="color:#e8c87a">
          <?= htmlspecialchars($r['json_datei']) ?>
        </a>
        <?php else:?>—<?php endif?></td>
      <td><?= htmlspecialchars($r['json_version']??'—') ?></td>
      <td class="<?=$cls?>"><?=$icon?> <?= htmlspecialchars($r['klasse']) ?></td>
    </tr>
    <?php endforeach?>
    </tbody>
  </table>
</div>
<?php endif?>

<!-- ── Index-Generator ── -->
<div class="index-generator-box">
  <h3>⚙ GRAPPA-Werkzeuge</h3>
  <div class="form-row" style="flex-wrap:wrap;gap:6px">
    <a href="<?= htmlspecialchars(buildUrl(array_merge($baseParams,['action'=>'build_index']))) ?>">
      <button type="button" class="primary">📋 Grappa_artikel.json</button>
    </a>
    <a href="<?= htmlspecialchars(buildUrl(array_merge($baseParams,['action'=>'check_art']))) ?>">
      <button type="button" class="primary">🔬 ART-Konsistenz</button>
    </a>
    <a href="<?= htmlspecialchars(buildUrl(array_merge($baseParams,['action'=>'export_scan']))) ?>">
      <button type="button">📤 Scan exportieren (UTC_HOST_DIR.json)</button>
    </a>
    <a href="<?= htmlspecialchars(buildUrl(array_merge($baseParams,['action'=>'build_artifact']))) ?>">
      <button type="button">🔧 buildGrappaArtifact()</button>
    </a>
    <a href="<?= htmlspecialchars(buildUrl(array_merge($baseParams,['action'=>'generate_art_nr']))) ?>">
      <button type="button">🆕 Neue ART-Nr</button>
    </a>
    <!-- lsfilter-Bridge -->
    <a href="<?= htmlspecialchars(GrappaUrl::lsfilterUrl('./lsfilter.php',$pattern,$grepStr)) ?>" target="_blank">
      <button type="button" class="lsfilter">📁 In lsfilter öffnen</button>
    </a>
  </div>
  <div class="ig-info">
    OP-34a: Arbeitsdateien (<code>_vXX.YY.*</code>) automatisch ausgeschlossen · §17.3<br>
    Export: UTC_HOST_DIR.json · merge-fähig · Rollback: .last_export.json.bak<br>
    lsfilter-Bridge: URL-Parameter q1/q2 · Sonderzeichen via http_build_query() korrekt enkodiert
  </div>
</div>

<!-- ── Footer ── -->
<footer class="site-footer">
  <p>🥃 GRAPPA FREE FRAMEWORK · <?= htmlspecialchars($iv['framework_version']) ?> · AGPL-3.0</p>
  <p><?= htmlspecialchars($iv['artikel_version']) ?> · <?= htmlspecialchars($iv['art_nr']) ?> · <?= htmlspecialchars($iv['autor']) ?></p>
  <p>© 2026 rcpffm · <a href="<?= htmlspecialchars($iv['lizenz_url']) ?>" rel="license" style="color:#555">AGPL-3.0</a> · <a href="<?= htmlspecialchars($iv['quellcode']) ?>" style="color:#555">Quellcode</a></p>
  <p style="color:#333;margin-top:.3rem">🖖 „To boldly go where no framework has gone before." — USS GRAPPA NCC-rcpffm-claude</p>
</footer>

</div>

<script>
// ═══════════════════════════════════════════════════════════════
//  GrappaSound · Akustische Signale · Web Audio API · als Klasse
//  Kein externes File · kein CDN · GRAPPA-konform · degoogle
// ═══════════════════════════════════════════════════════════════
class GrappaSound {
    static _ctx = null;

    static _getCtx() {
        if (!this._ctx) {
            const AC = window.AudioContext || window.webkitAudioContext;
            if (!AC) return null;
            try { this._ctx = new AC(); } catch(e) { return null; }
        }
        return this._ctx;
    }

    /**
     * Klacker · kurze Bestätigung · bei Suchergebnis
     * Original aus v03.06 · jetzt als Klasse
     */
    static klacker(count = 5) {
        const ctx = this._getCtx();
        if (!ctx) return;
        const now = ctx.currentTime;
        for (let i = 0; i < count; i++) {
            const osc  = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.frequency.value = 600 + i * 150;
            gain.gain.setValueAtTime(0.08, now + i * 0.08);
            gain.gain.exponentialRampToValueAtTime(0.001, now + i * 0.08 + 0.06);
            osc.connect(gain); gain.connect(ctx.destination);
            osc.start(now + i * 0.08); osc.stop(now + i * 0.08 + 0.06);
        }
    }

    /**
     * Feuerwerk · Ende langer Prozesse · deutliches Signal
     * Burst-Sequenz: Aufstieg + Explosion + Nachknall
     */
    static fireworks() {
        const ctx = this._getCtx();
        if (!ctx) return;
        const now = ctx.currentTime;

        // Aufstieg: ansteigende Töne
        for (let i = 0; i < 8; i++) {
            const osc  = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.frequency.setValueAtTime(200 + i * 80, now + i * 0.06);
            osc.frequency.exponentialRampToValueAtTime(800 + i * 80, now + i * 0.06 + 0.05);
            gain.gain.setValueAtTime(0.06, now + i * 0.06);
            gain.gain.exponentialRampToValueAtTime(0.001, now + i * 0.06 + 0.05);
            osc.connect(gain); gain.connect(ctx.destination);
            osc.start(now + i * 0.06); osc.stop(now + i * 0.06 + 0.05);
        }

        // Explosion: breiter Rausch-Burst
        const burstTime = now + 0.55;
        for (let i = 0; i < 12; i++) {
            const osc  = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sawtooth';
            osc.frequency.value = 300 + Math.random() * 1200;
            gain.gain.setValueAtTime(0.07, burstTime + i * 0.02);
            gain.gain.exponentialRampToValueAtTime(0.001, burstTime + i * 0.02 + 0.15);
            osc.connect(gain); gain.connect(ctx.destination);
            osc.start(burstTime + i * 0.02); osc.stop(burstTime + i * 0.02 + 0.15);
        }

        // Nachknall: tiefer Abschluss
        const endTime = now + 0.9;
        const oscEnd  = ctx.createOscillator();
        const gainEnd = ctx.createGain();
        oscEnd.frequency.value = 120;
        gainEnd.gain.setValueAtTime(0.12, endTime);
        gainEnd.gain.exponentialRampToValueAtTime(0.001, endTime + 0.3);
        oscEnd.connect(gainEnd); gainEnd.connect(ctx.destination);
        oscEnd.start(endTime); oscEnd.stop(endTime + 0.3);
    }

    /**
     * Ping · einfache Bestätigung · kurz
     */
    static ping() {
        const ctx = this._getCtx();
        if (!ctx) return;
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.frequency.value = 880;
        gain.gain.setValueAtTime(0.1, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.2);
        osc.connect(gain); gain.connect(ctx.destination);
        osc.start(); osc.stop(ctx.currentTime + 0.2);
    }
}

// Klacker bei Suchergebnis (Original-Verhalten)
<?php if ($totalFiles > 0): ?>
try { GrappaSound.klacker(<?= min($totalFiles, 8) ?>); } catch(e) {}
<?php endif?>

// Feuerwerk bei langen Aktionen (Export, build_index)
<?php if (in_array($action, ['export_scan','build_index','check_art']) && !empty($actionResult['success'])): ?>
try { GrappaSound.fireworks(); } catch(e) {}
<?php endif?>

// ── GGSTC ────────────────────────────────────────────────────────
(function() {
    function calcGgstc() {
        var now=new Date(),year=now.getUTCFullYear();
        var start=Date.UTC(year,0,1);
        var doy=Math.floor((Date.UTC(year,now.getUTCMonth(),now.getUTCDate())-start)/86400000)+1;
        var isLeap=(year%4===0&&(year%100!==0||year%400===0));
        var sec=now.getUTCHours()*3600+now.getUTCMinutes()*60+now.getUTCSeconds();
        return((year-2323)*1000+(doy/(isLeap?366:365))*1000+(sec/86400)).toFixed(4);
    }
    function setMode(m){var el=document.getElementById('ggstc-mode');if(!el)return;
        el.textContent=m==='py'?'🖖 Py':'⚠ JS';el.className=m==='py'?'py-mode':'js-mode';}
    function upd(){var el=document.getElementById('ggstc-display');if(el)el.textContent=calcGgstc();}
    upd();setMode('js');var ji=setInterval(upd,10000);
    var att=0,wi=setInterval(function(){att++;
        if(typeof window.ggstc_update==='function'){clearInterval(wi);clearInterval(ji);setMode('py');
            setInterval(function(){try{window.ggstc_update();}catch(e){}},10000);
        }else if(att>=60)clearInterval(wi);},500);
})();

// ── eruda · 3× Klick ─────────────────────────────────────────────
(function(){var c=0,t=null;
    document.addEventListener('DOMContentLoaded',function(){
        var v=document.getElementById('version-display');if(!v)return;
        v.addEventListener('click',function(){c++;if(t)clearTimeout(t);
            t=setTimeout(function(){c=0;},900);
            if(c>=3){c=0;if(typeof eruda!=='undefined'){eruda.init();eruda.show();}
                else{var s=document.createElement('script');s.src='https://cdn.jsdelivr.net/npm/eruda';
                    s.onload=function(){eruda.init();eruda.show();};document.head.appendChild(s);}}});});
})();

// ── validateImportantValues ───────────────────────────────────────
(function(){
    var _artNr='<?= addslashes($iv['art_nr']) ?>';
    var _artVer='<?= addslashes($iv['artikel_version']) ?>';
    var _fwVer='<?= addslashes($iv['framework_version']) ?>';
    var _datPHP='<?= addslashes($iv['datei_php']) ?>';
    fetch('./'+_artNr+'.json')
        .then(function(r){if(!r.ok)throw new Error('HTTP '+r.status);return r.json();})
        .then(function(data){
            var checks=[
                ['art_nr→art',String(data['art']||''),_artNr],
                ['artikel_version',String(data['artikel_version']||''),_artVer],
                ['framework_version',String(data['framework_version']||''),_fwVer],
                ['datei_php',String(data['datei_php']||''),_datPHP],
            ];
            var drifts=[];
            checks.forEach(function(c){if(c[1]!==c[2])drifts.push(c[0]+': IV='+JSON.stringify(c[2])+' ≠ JSON='+JSON.stringify(c[1]));});
            if(drifts.length>0){
                var b=document.getElementById('grappa-drift-banner');
                var d=document.getElementById('grappa-drift-details');
                if(b&&d){d.textContent=drifts.join(' · ');b.style.display='block';}
                console.error('⚠ GRAPPA DRIFT:',drifts);
            }else{console.log('✅ GRAPPA validate: OK · '+_artNr+' · '+_artVer);}
        }).catch(function(e){console.log('GRAPPA validate: '+e.message);});
})();

// ── SEO DOM-Patches ───────────────────────────────────────────────
document.addEventListener('DOMContentLoaded',function(){
    var md=document.getElementById('meta-desc');if(md)md.content='<?= addslashes($iv['beschreibung']) ?>';
    var mk=document.getElementById('meta-kw');if(mk)mk.content='<?= addslashes($iv['keywords']) ?>';
    var ogt=document.querySelector('meta[property="og:title"]');if(ogt)ogt.content='<?= addslashes($iv['og_titel']) ?>';
    var ogd=document.querySelector('meta[property="og:description"]');if(ogd)ogd.content='<?= addslashes($iv['og_beschreibung']) ?>';
});

// ── Toggle Pills ──────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded',function(){
    ['fnc','gnc','gwf','regex'].forEach(function(id){syncPill(id);});
});
function syncPill(cbId){
    var cb=document.getElementById(cbId);var pill=document.getElementById('pill-'+cbId);
    if(!cb||!pill)return;
    cb.checked?pill.classList.add('active'):pill.classList.remove('active');
    cb.addEventListener('change',function(){cb.checked?pill.classList.add('active'):pill.classList.remove('active');});
}

// ── setPattern · Schnellwahl ──────────────────────────────────────
function setPattern(val,isRegex){
    var p=document.getElementById('patternInput');if(p)p.value=val;
    var cb=document.getElementById('regex');if(cb){cb.checked=isRegex;syncPill('regex');}
}

// ── setGrep ───────────────────────────────────────────────────────
function setGrep(val){
    var el=document.getElementById('grepInput');
    if(el){var ta=document.createElement('textarea');ta.innerHTML=val;el.value=ta.value;
        var kl=document.getElementById('keyListInput');if(kl)kl.value='';}
}

// ── openFile ─────────────────────────────────────────────────────
function openFile(url,name){
    var s=lsGetState();
    try{localStorage.setItem(LS_KEY,JSON.stringify(s));}catch(e){}
    if(confirm('Datei öffnen?\n'+name))window.open(url,'_blank');
}

// ── LocalStorage ─────────────────────────────────────────────────
var LS_KEY='brutalsuche_v0403';
function lsGetState(){
    return{pattern:(document.getElementById('patternInput')||{}).value||'',
           grep:(document.getElementById('grepInput')||{}).value||'',
           keylist:(document.getElementById('keyListInput')||{}).value||'',
           regex:!!(document.getElementById('regex')||{}).checked,
           gwf:!!(document.getElementById('gwf')||{}).checked,
           gnc:!!(document.getElementById('gnc')||{}).checked,
           fnc:!!(document.getElementById('fnc')||{}).checked,
           ts:new Date().toISOString()};
}
function lsSave(){
    var s=lsGetState();
    try{localStorage.setItem(LS_KEY,JSON.stringify(s));
        var el=document.getElementById('ls-info');if(el)el.textContent='💾 '+s.ts.substr(0,19).replace('T',' ');}
    catch(e){alert('LS: '+e.message);}
}
function lsLoad(){
    var raw=localStorage.getItem(LS_KEY);if(!raw){alert('Kein gespeicherter Zustand.');return;}
    try{var s=JSON.parse(raw);
        var p=document.getElementById('patternInput');if(p)p.value=s.pattern||'';
        var g=document.getElementById('grepInput');if(g)g.value=s.grep||'';
        var k=document.getElementById('keyListInput');if(k)k.value=s.keylist||'';
        ['gwf','gnc','fnc'].forEach(function(id){var el=document.getElementById(id);if(el)el.checked=!!s[id];syncPill(id);});
        document.getElementById('mainform').submit();}
    catch(e){alert('LS laden: '+e.message);}
}
function lsDel(){
    if(confirm('Gespeicherten Zustand löschen?')){
        try{localStorage.removeItem(LS_KEY);var el=document.getElementById('ls-info');if(el)el.textContent='— gelöscht —';}
        catch(e){alert('LS: '+e.message);}}}

document.addEventListener('DOMContentLoaded',function(){
    var el=document.getElementById('ls-info');
    try{var raw=localStorage.getItem(LS_KEY);
        if(el&&raw){var s=JSON.parse(raw);el.textContent='💾 '+(s.ts?s.ts.substr(0,19).replace('T',' '):'?');}}
    catch(e){}});

// ── URL History bereinigen ────────────────────────────────────────
if(window.history&&window.history.replaceState){
    var url=new URL(window.location.href);
    var toDel=[];
    url.searchParams.forEach(function(v,k){if(!v||v==='')toDel.push(k);});
    toDel.forEach(function(k){url.searchParams.delete(k);});
    url.searchParams.delete('action');
    window.history.replaceState({},'',url.toString());
}

// ── console.log ──────────────────────────────────────────────────
console.log('GRAPPA · <?= addslashes($iv['datei_php']) ?> · <?= addslashes($iv['artikel_version']) ?> · <?= addslashes($iv['framework_version']) ?> · <?= addslashes($iv['art_nr']) ?>');
</script>
</body>
</html>
