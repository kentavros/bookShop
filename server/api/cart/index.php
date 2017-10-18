<?php
include '../../app/lib/function.php';
class Cart extends RestServer
{
    private $model;
    private $response;

    /**
     * create obj - model & response
     * parent run method
     * Books constructor.
     */
    public function __construct()
    {
        $this->model = new ModelCart();
        $this->response = new Response();
        $this->run();
    }

    public function getCart($param)
    {
        try
        {
            $result = $this->model->getBooksByIdClient($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }


    public function postCart($param)
    {
        try
        {
            $result = $this->model->addToCart($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function putCart($param)
    {
        try
        {
            $result = $this->model->updateCart($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
             return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function deleteCart($param)
    {
        try
        {
            $result = $this->model->clearCart($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$books = new Cart();
