
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://media-exp1.licdn.com/dms/image/C4E1BAQEDDjuh9HQchg/company-background_10000/0/1610631110628?e=2159024400&v=beta&t=00JMFny1Y6JiSd8rpPDIfJ_6vNH6NhtCK_yban1zy3c" alt="Build Status"></a>
</p>

## Proyecto
- Aplicación web en PHP utilizando Laravel 7.
- Mercado de aplicaciones donde los usuarios puedan listar apps, ver información adicional, comprarlas, crearlas, etc.
- Con Diferentes accesos:
  - Usuario Desarrollador
  - Usuario Cliente
  - Usuario Invitado (no logueado)

## Detalles

* Base de datos:
  - app_store
* Tablas:
  - APPS
    - id            BIGINT (PK)
    - category      VARCHAR
    - name          VARCHAR
    - price         DOUBLE
    - logo          VARCHAR
    - description   VARCHAR
    - created_by    INT
    - created_at    TIMESTAMP
    - updated_at    TIMESTAMP
    - deleted_at    TIMESTAMP
  - PURCHASES
    - id            BIGINT (PK)
    - user_id       BIGINT (FK)
    - app_id        BIGINT (FK)
    - created_at    TIMESTAMP
    - updated_at    TIMESTAMP
  - USERS
    - id                BIGINT (PK)
    - email             VARCHAR
    - user              VARCHAR
    - email_verified_at TIMESTAMP
    - password          VARCHAR
    - developer         BOOLEAN
    - remember_token    VARCHAR
    - created_at        TIMESTAMP
    - updated_at        TIMESTAMP

# Autor
Emiliano González - emiliano_g06@hotmail.com
