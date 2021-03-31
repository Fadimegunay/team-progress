# Takım Çalışması
Birden fazla takım tanımlanarak bu takımlara veya kullanıcılarına görev atamalarının yapılabildiği, aynı zamanda rol tanımlamalarının dinamik bir şekilde gerçekleştirilebildiği bir sistem.

## Kurulum
* <code>cd</code>  komutunu kullanarak  dosya dizinine ilerleyin
* <code>.env.example</code> dosyasını <code>.env</code> dosyasına kopyalın ve database bilgilerinizi doldurun
* Sırasıyla  <code>composer install </code> ve <code>composer update</code> komutlarını çalıştırın
* <code>php artisan key:generate</code> komutunu çalıştırın
* Sırasıyla <code>php artisan migrate</code> ve <code>php artisan db:seed</code> komutlarını çalıştırın

NOT : seeder kısmını çalıştırmadan önce kendi giriş bilgilerinizi UsersTableSeeder alanına girebilirsiniz.
