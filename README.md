## Tecnologias/Pacotes

- [Laravel](https://laravel.com/docs/master)

## Dependências

- PHP 8.2 ou Maior
- Composer
- Docker
- Docker Compose

## Como Usar?

Faça o clone do projeto e siga o passo a passo de execução dos comandos


** Mude as variáveis de ambiente para as suas configurações.
```bash
# cp .env.example .env
```

Execute o container para rodar a aplicação.

```bash
# composer install
# ./vendor/bin/sail up
```

Execute o comando para as migrations

```bash
# ./vendor/bin/sail artisan migrate
```


## API

A API foi documentada via Postman. A collection foi disponibilizada na raiz do projeto com o nome: "API_Despesas.postman_collection.json"
