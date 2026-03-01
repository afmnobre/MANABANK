<?php

class ClienteController
{
    public function index()
    {
        $clienteModel = new Cliente();
        $clientes = $clienteModel->listarComLojasECardgames();

        ob_start();
        require __DIR__ . '/../Views/clientes/index.php';
        $content = ob_get_clean();

        $title = "Clientes";
        require __DIR__ . '/../Views/layout/layout.php';
    }

    // AJAX: pedidos de um cliente
    public function pedidos($id_cliente)
    {
        $clienteModel = new Cliente();
        $pedidos = $clienteModel->pedidosPorCliente($id_cliente);

        header('Content-Type: application/json');
        echo json_encode($pedidos);
        exit;
    }
}

