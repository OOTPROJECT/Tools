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
