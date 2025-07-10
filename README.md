# Laravel Livewire Product Search

Este projeto é um exemplo de busca de produtos com filtros combinados (nome, categoria, marca) usando Laravel, Livewire, Docker e MySQL.

---

## 🚀 Instalação e Configuração do Ambiente

### 1. **Clone o repositório**

```sh
git clone https://github.com/SEU_USUARIO/SEU_REPOSITORIO.git
cd SEU_REPOSITORIO
```

### 2. **Copie o arquivo de ambiente**

```sh
cp .env.example .env
```

### 3. **Configure as variáveis do banco de dados no `.env`**

Exemplo para uso com Docker:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=teste
DB_USERNAME=thalles
DB_PASSWORD=sua_senha
```

### 4. **Suba os containers Docker**

```sh
docker-compose up -d
```

### 5. **Instale as dependências do PHP**

```sh
docker-compose exec app composer install
```

### 6. **Gere a chave da aplicação**

```sh
docker-compose exec app php artisan key:generate
```

### 7. **Rode as migrations**

```sh
docker-compose exec app php artisan migrate
```

---

## 🗄️ Populando o Banco de Dados com Tinker

Você pode criar dados de exemplo usando o Tinker e as factories do Laravel.

### 1. **Acesse o Tinker dentro do container**

```sh
docker-compose exec app php artisan tinker
```

### 2. **Crie categorias, marcas e produtos**

No prompt do Tinker, execute:

```php
\App\Models\Category::factory()->count(5)->create();
\App\Models\Brand::factory()->count(5)->create();
\App\Models\Product::factory()->count(20)->create();
```

Isso irá criar 5 categorias, 5 marcas e 20 produtos de exemplo.

---

## 🖥️ Acessando a Aplicação

Acesse no navegador:

```
http://localhost:8000
```

---

## 🧹 Comandos Úteis

- **Limpar cache de views/config:**
  ```sh
  docker-compose exec app php artisan view:clear
  docker-compose exec app php artisan config:clear
  docker-compose exec app php artisan cache:clear
  ```

- **Rodar migrations novamente (apaga tudo e recria):**
  ```sh
  docker-compose exec app php artisan migrate:fresh --seed
  ```

---

## 📝 Observações

- Sempre execute comandos Artisan dentro do container Docker.
- O Livewire já está configurado para busca reativa e filtros combinados.
- Para cadastrar produtos manualmente, use o Tinker ou crie um formulário conforme sua necessidade.

---

## 📄 Licença

Este projeto é open-source e está sob a licença MIT.


