# Challenge Frontend - Grupo Alianza
Proyecto desarrollado en PHP basado en Laravel11, VueJS3 e Inertia.
El objetivo de esta aplicación web es registrar los datos de empleados, asociarlos a un cargo y definir cuál es su jefe inmediato.

#### Tecnologias Utilizadas:
- Laravel 11, PHP 8, Composer, MySQL, Vite, Vue3 usando Composition API e Inertia.

#### Como instalar:
Configuración del proyecto:

1. **Clonar repositorio**: Clone este mismo repositorio en su máquina local.

   ```
   git clone https://github.com/jhoanrcode/frontend-challenge-alianza.git
   ```

2. **Instalación de dependencias**: Utilice Composer para instalar todas las dependencias del proyecto Laravel.

   ```
   composer install
   ```

3. **Configuración de ambiente**: Cree el archivo `.env` y modifíquelo usando el archivo `.env.example` y actualice la información de conexion a base de datos `DB_DATABASE=mydbname`. 
   ```
   cp .env.example .env
   ```
   
3. **Genere la application key**:  
   ```
   php artisan key:generate
   ```
   
4. **Ejecutar migraciones**: Ejecute las migraciones de Laravel para crear las tablas necesarias en base de datos.

   ```
   php artisan migrate
   ```
   
5. **Ejecutar librerias framework Vue**: Ejecute librerias con `npm install` y `npm run dev`.
   ```
   npm install 
   ```
   ```
   npm run dev
   ```

6. **Ejecutar el servidor**: 

   ```
   php artisan serve
   ```

### Como ingresar y navegar:
- Primero deberas crear una cuenta para poder realizar autenticacion de usuarios `/register`
- Si ya cuentas con un usuario realiza el login: `/login`
- Crea empleados: `/empleados`
- Asociar empleados a cargos: `/cargos`
   
