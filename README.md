# Walnut Task

Laravel & Node.js projesi

### Walnut News

<ul>
    <li>Node.js</li>
    <li>Express.js</li>
    <li>Puppeteer</li>
</ul>

<p>
    Haber başlıkları ve kelime sayıları, Puppeteer kullanılarak, www.bbc.com/turkce adresinden çekilerek 
    http://localhost:3000/api/news?url=https://www.bbc.com/turkce üzerinden yayınlandı.
</p>

### Walnut Portal

<ul>
    <li>Php</li>
    <li>Laravel</li>
</ul>

<p>
    AdminUsers, CallbackLogs, IncomingLogs, IncomingLogData veritabanı tabloları oluşturuldu.
</p>
<p>
    CallbackController ve TestController sınıfları oluşturuldu.
</p>
<p>
    CallbackController içerisindeki callback methodu içerisinde walnut-news apisine istek atılarak haberler çekilerek veritabanına kaydedildi.
</p>
<p>
    CallbackController içerisinden TestController içerisindeki /test-receiver endpoint'ine istek atılarak gelen veriler veritabanına kaydedildi.
</p>

