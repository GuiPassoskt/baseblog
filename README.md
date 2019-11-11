# Guia de implementação

Após clonar esse projeto para a máquina, as seguintes instruções são necessárias

- Navegue até a pasta do projeto e rode o comando `composer install`

- Após isso, copie o `.env.example` para `.env`. Você pode fazer isso rodando o comando `cp .env.example .env`

- Rode o comando `php artisan key:generate`. O Laravel exibe isso para uma instalação recente.

- Altere as seguintes variáveis para configurar o banco de dados local:

```
DB_HOST=127.0.0.1
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

- Após configurar a variável, você precisa criar um banco de dados novo no Mysql. Deve ser o mesmo nome da variável `DB_DATABASE`

- Rode o comando `php artisan migrate` para criar as tabelas.

- Rode o comando `php artisan storage:link` para gerar o link simbólico para a pasta de uploads.
- Crie a pasta `public` dentro de `storage/app`.  Caso seja necessário, dê permissão com `sudo chmod -R 777 storage/app/public`.

- Rode o comando `php artisan make:user` para criar um novo usuário. 
Se for necessário mudar a senha de um usuário existente, basta rodar o comando e usar o mesmo e-mail digitado anteriormente.

- E por fim, rode `php artisan serve` para rodar o servidor


