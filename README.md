## Instalação
- git clone
- criar arquivo .env
- cp .env.example .env (linux)
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

Traz os pedidos e seus itens. GET

- localhost:8000/api/reservar

Esta api recebe o pedido e a quantidade de itens serão reservados. POST

{
	"reserva":
	[
		{
		"numero_do_pedido" : 1054366,
		"produtoId": 2,
		"reserva": 500
		},
		{
		"numero_do_pedido" : 5,
		"produtoId": 5,
		"reserva": 1
		},
				{
		"numero_do_pedido" : 10,
		"produtoId": 3,
		"reserva": 10
		}
	]
}

- localhost:8000/api/finalizar
- 
Esta api faz a baixa no estoque.


## Validações

O projetos tem algumas validações:

- Caso tente reservar um produto que não existe para o pedido, é retornado uma mensagem: Produto 999999 não existe para o pedido 10.
- Caso as reservas ultrapassem o estoque atual, retorna a mensagem: Total de estoque menor que a reserva. Reservados 99999 estoque 50.
- Caso envie um pedido que não existe no momente da reserva: Pedido 46545 não encontado.
- Caso passe nas validações retorna mensagem de sucesso.

