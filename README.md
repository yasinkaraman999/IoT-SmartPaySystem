# SmartPaySystem
<h1>RFID temelli Linux destekli temassız ödeme sistemi.</h1>

<p>Özet<br>
Otobüslerde kullanılmak üzere temassız okuma ile ödeme yapılan sistem.
</p>
<p>
Tanım<br>
SMARTCARD sistemi(donanım) otobüslere kurulur ve yolculardan talep edilen ücretler SMARTCARD vasıtasıyla tahsil edilir. Bakiye tükendiğinde sade ve basit tasarımlı Web sitesinden bakiye yüklemesi gerçekleştirebilir ve kart kullanım geçmişine(Günlük/Aylık/Genel)  ulaşabilirsiniz.
</p>

<h3>Materyal</h3>
<table >
    <tr >
        <th >Yazılım</th>
        <th>Donanım</th>
    </tr>
    <tr>
        <td>Ubuntu 18.4.2 OS</td>
        <td>1 Adet esp32 Dev Module</td>
    </tr>
    <tr>
        <td>Node-Red
        </td>
        <td>1 Adet RFID RC522</td>
    </tr>
    <tr>
        <td>Mosca MQTT Broker</td>
        <td>1 Adet Buzzer</td>
    </tr>
    <tr>
        <td>MYSQL</td>
        <td>2 Adet Led</td>
    </tr>
    <tr>
        <td>APACHE</td>
        <td>2 Adet 220k Direnç</td>
    </tr>
    <tr>
        <td>Arduino IDE</td>
        <td>1 Adet BreadBoard</td>
    </tr>
</table>


<br>

<h2>Yöntem</h2>
<p>
Ubuntu sunucu üzerine Node-Red,Mosca MQTT Broker,MYSQL,Apache kurulumları yapıldı. RFID kartları kullanmak için RC522 modülünü Esp32 kartına bağlandı ve SPI haberleşme başlatıldı. Sonrasında Esp32 ile Node-Red iletişimi için MQTT Broker kullanıldı ve okunan kart numarası sunucuya iletildi. Mosca MQTT ile alınan kart numarası MYSQL veri tabanında sorguladı. Alınan çıktıya göre bakiye yeterli ise karttan bakiye düşüldü,
hareket geçmişine bilgiler kaydedildi ve MQTT ile kalan bakiye bilgisi Serial Monitor ile gösterildi. Bakiye yetersiz veya okutulan kart sistemde tanımlı değilse işlenen bilgi Esp32 ye MQTT ile aktarıldı.<br>
Geri besleme alan Esp32 veriyi yorumlayarak kullanıcıya Serial Monitor de  bilgilendirme mesajı ,led  ve  buzzer ile de bildirimde bulundu.<br>
Kart kullanıcıları bakiyelerini ,geçmişe dönük kart hareketlerini gözlemlemek  ve bakiye yüklemek için  Web sitesi hazdırlandı.
</p>
