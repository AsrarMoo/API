# استخدم صورة PHP الرسمية مع Apache
FROM php:8.1-apache

# تفعيل mod_rewrite (مهم لتطبيقات مثل Laravel)
RUN a2enmod rewrite

# نسخ ملفات التطبيق إلى الحاوية
COPY . /var/www/html/

# تثبيت امتدادات PHP المطلوبة
RUN docker-php-ext-install pdo pdo_mysql

# تعيين المجلد العام (public) كمجلد العمل إذا كنت تستخدم Laravel
WORKDIR /var/www/html/public

# فتح المنفذ 80 (لـ Apache)
EXPOSE 80

# تشغيل Apache في الخلفية
CMD ["apache2-foreground"]
