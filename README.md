# Tools
1. download xampp url: https://www.apachefriends.org/download.html เลือก version 5.6.30 / PHP 5.6.30
2. download composer url: https://getcomposer.org/download/
3. download nodejs url: https://nodejs.org/en/download/

# Install
1. install xampp on windows or mac (ติดตั้งไม่ยาก step click เสร็จแล้วลอง start apache กับ mysql แล้วเปิด brownser พิมพ์ url: localhost)
2. install composer หลังจากติดตั้งเสร็จแล้ว ให้เข้าไปที่ windows command line และพิมพ์คำสั่ง composer --version เสร็จแล้ว enter จะเห็น version ของ composer แสดงว่าติดตั้ง composer สำเร็จเรียบร้อย
3. install nodejs ที่ download มาตามลิงค์ข้อที่ 3 (ลง nodejs เพื่อใช้งาน node package manager npm ใช้ติดตั้ง vueJS และจัดการ package js,css สำหรับ fontend)

# Clone laravel-kingmath project
ใช้ gitkraken หรือ github ก็ได้ clone project ไปไว้ที่ directory ที่ได้ติดตั้ง xampp ไว้ เอา project วางไว้ที่ \xampp\htdocs

# run composer install package in laravel-kingmath
1. เปิด windows command line แล้ว cd เข้าไปที่ directory ที่ติดตั้ง xampp ไว้ และ cd เข้าไป htdocs\laravel-kingmath
2. พิมพ์ composer install
3. copy file .env.example ไว้ที่ htdocs\laravel-kingmath
4. เปลี่ยนชื่อไฟล์ .env.example เป็น .env (ถ้า windows ไม่ยอมให้เปลี่ยน แนะนำให้เปิด project นี้ใน atom แล้วไปคลิก rename ที่ไฟล์ เป็น .env)
5. เปิด windows command line แล้ว cd เข้าไปที่ directory ที่ติดตั้ง xampp ไว้ และ cd เข้าไป htdocs\laravel-kingmath
6. พิมพ์ php artisan key:generate เพื่อ generate app key
5. เปิด brownser พิมพ์ url: localhost/laravel-kingmath/public จะเห็นหน้า login (อย่าลืม! start apache, mysql ที่ xampp)

# Database & Environment configuration 
1. เปิดไฟล์ .env
2. เปลี่ยนชื่อ db, db username, password ตามที่ติดตั้งไว้บนเครื่องของตัวเอง 
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=
  DB_USERNAME=
  DB_PASSWORD=

# Migration & Seed sample data
1. เปิด windows command line แล้ว cd เข้าไปที่ directory ที่ติดตั้ง xampp ไว้ และ cd เข้าไป htdocs\laravel-kingmath
2. พิมพ์ php artisan migrate (สร้าง table)
3. ตรวจสอบว่า table ถูกสร้างหรือไม่ ให้เปิด brownser url: http://localhost/phpmyadmin เปิดดูตารางใน db ที่ config ไว้
4. พิมพ์ php artisan db:seed (ใส่ sample data ลงใน ตาราง users)
5. เปิดตาราง users จะเห็นข้อมูล user ที่ seed เข้าไป

# laravel-kingmath user login sample
u = admin@kingmath
pw = 12345678

# Atom editor set indent (4 space or 1 tab)
1. คลิกที่ menu >> Packages >> Setting View >> Open
2. เมนูด้านซ้าน เลือก editor >> เลื่อน scroll bar มาที่ Tab Length ใส่เลข 4 แทนเลข 2 (Laravel ใช้ 1 Tab, atom default: 2 space ให้เปลี่ยนเป็น 4)


