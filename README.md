<h1 align="center"> think-laradumps </h1>

<p align="center"> debug tool Using Laradumps App in ThinkPHP6</p>

<p align="center">
  <img src="./art/logo.png" height="128" alt="" />
</p>
<h1 align="center">LaraDumps</h1>
<div align="center">
  <br />
  <p align="center">
    <a href="https://github.com/laradumps/app/releases/download/v1.2.3/LaraDumps-Setup-1.2.3.exe">
      <img src="./art/os/windows.png" height="60" alt="LaraDumps Windows App" />
    </a>
    <a href="https://github.com/laradumps/app/releases/download/v1.2.3/LaraDumps-1.2.3.dmg">
      <img src="./art/os/macos.png" height="60" alt="LaraDumps MacOS App" />
    </a>
    <a href="https://github.com/laradumps/app/releases/download/v1.2.3/LaraDumps-1.2.3.AppImage">
      <img src="./art/os/linux.png" height="60" alt="LaraDumps Linux App" />
    </a>
  </p>
  <h3>Click on your OS logo to download the Desktop App.</h3>
  <sub>Available for Windows, Linux and macOS.</sub>
  <br />
  <br />
  <p>
    <a href="https://laradumps.dev"> ð Documentation </a>
  </p>
</div>
 <br/>


## å®è£

```shell
$ composer require yangweijie/think-laradumps --dev -vvv
```

## ç¨æ³

### ð Hello Dev,

<br/>

### Get Started

#### Requirements

PHP 7.2+ and ThinkPHP5.0+

> 5.0 è¦æå¨å¤å¶ `config/config.php` å° é¡¹ç®æ ¹ç®å½ `config/laradumps.php`

#### Usage

3. éç½® LaraDumps :

ç¼è¾ å®è£æ©å±åèªå¨åå»ºç laradumps éç½®æä»¶

4. è°è¯ä½ çä»£ç éè¿ä½¿ç¨ `ds()` å ThinkPHP åºç¨éç trace ä¸æ ·ä½¿ç¨ã

> dsd == halt

5. è¿è¡åºç¨ï¼ç¶åçå°è°è¯çä¿¡æ¯å¨ LaraDumps App çªå£éã

Here's an example:

```php
Route::get('/', function () {
    ds('Home page accessed!');
    return view('home');
});
```

```php
ds('')->phpinfo();
```

```php
ds()->table([['id'=1,'name'=>'a']], 'table');
```

```php
ds()->time('event');
ds()->stopTime('event');

```
```php
ds('è°è¯ä¿¡æ¯1')->s('tab1'); // å¯ä»¥è¾åºä¸åè°è¯å°ä¸åtab
```

è³äºæ¾ç¤ºæ¥å¿åè½ï¼åçå¬sqlï¼åèèè¦ä¸è¦å®ç°ï¼å ä¸ºç®åè¿ä¸ªå½æ°è¾åºçæ¯åThinkPHP log ç¬ç«å¼æ¥çã
è¦é«åº¦æ©å±ï¼å¯ä»¥å®ç°åºäºæ¬åºåå®ç°ä¸ä¸ªlog çé©±å¨ï¼åæ¶åéç½®database ç trace å°±è¡äºã

## License

MIT