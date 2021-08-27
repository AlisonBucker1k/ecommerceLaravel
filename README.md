# Useladame

#### `admin.useladame.local `- sistema de gerenciamento do site e clientes
#### `uselademe.local` - site ecommerce com área do usuário

---

### Como rodar o projeto com Docker
1. Criar vHosts no seu PC
2. Rodar comando `docker-compose up -d`
3. Criar arquivo `.env` e copiar conteúdo do `.env.example` para dentro dele
4. Rodar comando `docker-compose exec node bower install`
4. Rodar comando `docker-compose exec php composer install`

#### Migrations
Comando: `php artisan migrate --seed`

ou `php artisan migrate` e depois `php artisan db:seed`

#### Rotas
> Admin: `./routes/admin.php`

> API: `./routes/api.php`

> Site: `./routes/site.php`
