# Setting up Hytale-Sync
[German](#German) | [English](#English)

## English
1. Install and configure [Hytale-Linker](https://github.com/xXSchrandXx/de.xxschrandxx.wsc.Hytale-linker/blob/main/Setup.md) and all required packages and plugins.
2. Install [Hytale-Sync](https://www.woltlab.com/pluginstore/file/7199-Hytale-sync/) via the store code, via the package search or as a file upload.
3. Configure Hytale Sync in the ACP under `Configuration > Options > Hytale > Hytale Sync`. (A server must be activated in the selection for Hytale Sync to work.)
5. Remember the URL for step 9.
6. Download [WSC-Sync](https://www.curseforge.com/hytale/mods/wsc-sync) and put it in your `mods` folder.
7. Restart your server.
8. Open the `config.json` in the `WSC-Hytale_WSC-Hytale-Sync` folder.
9. Set `url` to the URL from step 5.
10. Change `plugin` to your permission plugin.
List of supported [permission plugins](https://github.com/xXSchrandXx/WSC-Hytale-Sync/blob/main/src/main/java/de/xxschrandxx/wsc/wscsync/core/api/permission/PermissionPlugin.java).
11. Restart your server.
12. Configure your user groups under `Users > User groups > User groups > {user group entry}`. Modify the list under the `Hytale Sync` section.

## German
1. Installieren und konfigurieren Sie [Hytale-Linker](https://github.com/xXSchrandXx/de.xxschrandxx.wsc.Hytale-linker/blob/main/Setup.md) und alle erforderlichen Pakete und Plugins.
2. Installieren Sie [Hytale-Sync](https://www.woltlab.com/pluginstore/file/7199-Hytale-sync/) über den Store-Code, über die Paketsuche oder als Datei-Upload.
3. Konfigurieren Sie Hytale Sync im ACP unter `Konfiguration > Optionen > Hytale > Hytale Sync`. (Damit Hytale Sync funktioniert, muss ein Server in der Auswahl aktiviert sein.)
5. Merken Sie sich die URL für Schritt 9.
6. Laden Sie [WSC-Sync](https://www.curseforge.com/hytale/mods/wsc-sync) herunter und legen Sie es in Ihrem Ordner `mods` ab.
7. Starten Sie Ihren Server neu.
8. Öffnen Sie die Datei `config.json` im Ordner `WSC-Hytale_WSC-Hytale-Sync`.
9. Setzen Sie `url` auf die URL aus Schritt 5.
10. Ändern Sie `plugin` in Ihr Berechtigungs-Plugin.
Liste der unterstützten [Berechtigungs-Plugins](https://github.com/xXSchrandXx/WSC-Hytale-Sync/blob/main/src/main/java/de/xxschrandxx/wsc/wscsync/core/api/permission/PermissionPlugin.java).
11. Starten Sie Ihren Server neu.
12. Konfigurieren Sie Ihre Benutzergruppen unter `Benutzer > Benutzergruppen > Benutzergruppen > {Benutzergruppeneintrag}`. Ändern Sie die Liste im Abschnitt `Hytale Sync`.