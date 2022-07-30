# FlightPHP con Svelte JS

Instalación de dependencias:

    $ composer install

Servidor de desarrollo

    $ composer start

### Migraciones

Migraciones con DBMATE - accesos/sqlite3:

    $ dbmate -d "db/migrations" -e "DB" new <<nombre_de_migracion>>
    $ dbmate -d "db/migrations" -e "DB" up
    $ dbmate -d "db/migrations" -e "DB" rollback

## Archivo .env

    ENV="local"||"prod"

### Dump y Restore Mysql

    $ mysqldump -u root -p --ignore-table=vw_project_types_projects antergo > db/antergo.sql
    $ mysql -u root -p antergo < db/antergo.sql

## Habilitar GROUP BY MySQL

    $ SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

## Archivo .env en configs

    MAIL_SENDER="contacto@antergo.pe"
    MAIL_USER="demo@correo.pe"
    MAIL_PASS="demo123"
    MAIL_US="demo@correo.pe"
    MAIL_HOST="mail.correo.pe"
    MAIL_PORT=12
    PRIMARY="#c49536"
    SECONDARY="#7c7c80"
    NAME="Antergo Design"
    ABOUT="Somos una empresa Peruana de arquitectura y diseño interior, enfocada en atender las necesidades de sus clientes"
    ADRESS="Calle Mariano Pacheco 1073. La Victoria"
    PHONE="+51 901 268 633"
    EMAIL="proyectos@antergo.pe"
    MESSAGE="En breve uno de nuestros asesores se contactará con usted."

---

Video Tutorial Diseño

+ https://www.youtube.com/watch?v=XLp5kEfKe2k

Diseño Template

+ https://themewagon.com/themes/makan-free-responsive-bootstrap-5-html5-business-website-template/
+ https://technext.github.io/makan/

Iconos de servicios

+ https://www.flaticon.es/packs/interior-design-48?word=interior%20design
+ https://www.flaticon.es/packs/ecology-and-environment-33

Git:

    $ git push origin <local>:master

Fuentes:

+ https://github.com/pepeul1191/flightphp-boilerplate
+ https://codepen.io/wowthemesnet/pen/LgeQKd
+ https://www.wowthemes.net/bootstrap-4-split-screen-layout/
+ https://www.hostinger.es/tutoriales/como-usar-el-servidor-smtp-gmail-gratuito/
+ https://support.google.com/accounts/answer/185833?hl=es (contraseña de aplicaciones)
+ https://visionmedia.github.io/page.js/
+ https://stackoverflow.com/questions/25112510/how-to-set-environment-variables-from-within-package-json
+ https://gulpjs.com/docs/en/getting-started/creating-tasks
+ https://www.npmjs.com/package/cross-env
+ https://medium.com/@singdeep/secure-your-data-with-hash-sha256-encryption-and-decryption-method-using-php-8f3713ae467a
