## Instalação

- criar arquivo .env
- Composer install
- php artisan migrate
- php artisan db:seed --class=EstoquesSeeder
- php artisan db:seed --class=PedidosSeeder
- php artisan serve

## Informações
Os comandos:

- php artisan db:seed --class=EstoquesSeeder
- php artisan db:seed --class=PedidosSeeder

cria um estoque e um pedido para facilitar o teste da apis.

Temos as seguintes apis: 
- localhost:8000/api/pedidos
Traz os pedidos e seus itens

- localhost:8000/api/reservar
Esta api recebe o pedido e a quantidade de itens serão reservados.

- localhost:8000/api/finalizar
Esta api da a baixa no estoque.


## Validações

O projetos tem algumas validações:

- Caso tente reservar um produto que não existe para o pedido, é retornado uma mensagem: Produto 999999 não existe para o pedido 10.
- Caso as reservas ultrapassem o estoque atual, retorna a mensagem: Total de estoque menor que a reserva. Reservados 99999 estoque 50.
- Caso envie um pedido que não existe no momente da reserva: Pedido 46545 não encontado

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
