FROM php:8.1-apache

# Copy source code ไปที่เว็บรูท
COPY . /var/www/html/

# เปิด mod_rewrite (ถ้าต้องใช้)
RUN a2enmod rewrite

# ตั้ง permission (ถ้าจำเป็น)
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
CMD ["apache2-foreground"]
