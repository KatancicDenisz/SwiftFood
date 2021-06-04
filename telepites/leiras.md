

# Szerveroldali webprogramozás


## PHP és Composer telepítése

A labor gépeken (illetve sok esetben az otthoni gépeken is) be kell állítani egy lokális környezetet. Egy felhasználónak egy gépnél elég ezt egyszer elvégeznie. A labor gépeken például alapból nincs feltelepítve a PHP és a Composer. Ennek a menetét ez a fejezet részletezi.

### Automatikus telepítővel (Windows)

Készítettünk egy automatikus telepítőt, amivel a tárgyhoz szükséges eszközök telepítése egyszerűen elvégezhető.

Csak futtatni kell, és a telepítő automatikusan végrehajtja a következő pontban kifejtett lépéseket, így azokat optimális esetben nem szükséges kézzel megcsinálni. A telepítő futtatható a programok frissítéshez is, vagy rossz telepítés javítására.

Ha a telepítővel kapcsolatban bármilyen hibát észlelsz, akkor kérlek nyiss egy issue-t a telepítő repojában vagy írj egy e-mailt.

### Telepítés kézzel (Windows)

#### PHP telepítése
- A [https://windows.php.net/download](https://windows.php.net/download) oldalról a legfrissebb PHP kiadás __x64 Non Thread Safe__ verzióját kell letölteni, majd kicsomagolni.
- A __php.ini-development__ fájlról készítsünk egy másolatot, amit nevezzünk el __php.ini__-nek.
- Nyissuk meg a __php.ini__ fájlt, és hajtsuk végre a következő módosításokat:
  - Keressünk rá a következő sorra:  `;extension_dir = "ext"`, és "kommentezzük ki", vagyis hagyjuk el a pontosvesszőt az elejéről. Erre azért van szükség, hogy a PHP a saját mappájában keresse majd a kiegészítőket (mivel lokálisan telepítjük, és alapból nem jó helyen keresné).
  - Most pedig engedélyeznünk kell néhány kiegészítőt. A következő sorokat is élesítenünk kell (ezek kb. egy blokkban vannak):
     ```ini
    ;extension=fileinfo
    ;extension=mbstring
    ;extension=openssl
    ;extension=pdo_mysql
    ;extension=pdo_sqlite
    ```
- Ha kész vagyunk, mentsük el a __php.ini__ fájlt.
- Az egész mappa tartalmát másoljuk át ide: 
  `%LOCALAPPDATA%\Programs\php` (ha még nincs a Programs mappában php mappa, létre kell hozni).

Tipp: Fájlkezelő címsorába másoljuk be, hogy `%LOCALAPPDATA%\Programs`

#### XDebug kiegészítő telepítése a PHP-hoz
- A [https://xdebug.org/download](https://xdebug.org/download) oldalról a __Windows binaries__ részből válasszuk ki a telepített PHP verziónak megfelelőt (ne felejtsük el, hogy x86 / x64 kell-e, a TS a Thread Safe-t jelenti a végén, az aktuális PHP verziónkat és az architektúrát pedig a `php -v` parancs adja meg).
- Ha sikerült, mentsük el __php_xdebug.dll__ néven.
- Másoljuk be a PHP __ext__ mappájába a __php_xdebug.dll__ fájlt.
- Nyissuk meg a __php.ini__ fájlt, és írjuk az alábbiakat a fájl legaljára:
  ```ini
  [XDebug]
  xdebug.remote_enable = 1
  xdebug.remote_autostart = 1
  zend_extension=xdebug
  ```
- Mentsük el a __php.ini__ fájlt.
- Ha fut valamilyen PHP-s folyamat a gépen, akkor azt újra kell indítani annak érdekében, hogy betöltse ezt a kiegészítőt is.

#### Composer telepítése
- A [https://getcomposer.org/composer-stable.phar](https://getcomposer.org/composer-stable.phar) linkre kattintva töltsük le a legfrissebb Composer kiadást.
- A letöltött fájlt `composer.phar` néven bemásoljuk a következő mappába: `%LOCALAPPDATA%\Programs\composer` (ha még nincs a Programs mappában composer mappa, létre kell hozni).
- Szintén ebben a __composer__ mappában csinálunk egy `composer.bat` fájlt, aminek a tartalma a következő egy sor legyen: 
 `@php "%~dp0composer.phar" %*`

#### Hozzáadás a Path környezeti változóhoz
Ahhoz, hogy parancssorból meg tudjuk hívni a php, illetve a composer parancsokat, hozzá kell az előbb elkészített két mappát adni a Path környezeti változóhoz.

Ez a legegyszerűbben úgy tehető meg, hogy beírjuk a Start menü keresőbe, hogy "Fiókhoz tartozó környezeti változók szerkesztése", vagy angol Windowson "Edit environment variables for your account". Alternatív lehetőség a Win+R, majd `rundll32 sysdm.cpl,EditEnvironmentVariables` parancs kiadása.

Itt fontos, hogy a megjelenő ablak fenti részében dolgozzunk, mivel az vonatkozik a __felhasználó__ környezeti változóira, és a labor gépeken nem lehet módosítani a rendszerhez tartozó tulajdonságokat.

### Telepítés tesztelése
Ha minden fent ismertetett műveletet sikeresen elvégeztünk, a parancssorban elérhetővé válik a php és a composer (a már megnyitott parancssorokban nem, azokat újra meg kell nyitni), ezt így próbálhatjuk ki:
`php -v` és `composer -V`
Mindkét esetben ki kell írja a telepített verzió adatait.

A PHP-t részletesebben úgy tudod tesztelni, ha csinálsz például egy test.php nevű fájlt, amibe beleírod ezt:
```php
<?php
	phpinfo();
?>
```

Ezt követően nyiss egy parancssort az adott mappában, vagy cd parancssal lépj bele, utána add ki a következő parancsot: 
`php -S localhost:3000 test.php`

Majd a böngészőben nyisd meg a [http://localhost:3000/](http://localhost:3000/) oldalt.

Ez egy átfogó jelentést ad a PHP adatairól és beállításairól, pl. láthatod a verziószámát, bekapcsolt kiegészítőket, van-e XDebug, stb. A parancssort zárd be a végén.

## Visual Studio Code beállítása

Az órákon a Visual Studio Code-ot fogjuk használni, ezt mindenki telepítse fel, mivel a Live Share bővítmény által közösen is lehet dolgozni.

 Az alábbi kiegészítőket kell telepíteni:
- [Live Share](https://marketplace.visualstudio.com/items?itemName=MS-vsliveshare.vsliveshare)
- [Laravel Extension Pack](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-extension-pack)
  - Ez egy univerzális kiegészítő csomag, ami lefed mindent, amire a PHP/Laravel vonalon szükségünk van.
  - A PHP Debug működéséhez szükség van az XDebug-ra is (az automatikus telepítő script felrakja, de le van írva a kézi telepítés menete is)

## Segítség
Ha a telepítéssel kapcsolatban kérdésed van, keress bátran és segítek szívesen (totadavid95@inf.elte.hu vagy Teams chat).