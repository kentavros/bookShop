<?php
include '../../app/lib/function.php';
class Orders extends RestServer
{
    private $model;
    private $response;

    /**
     * create obj - model & response
     * parent run method
     * Payment constructor.
     */
    public function __construct()
    {
        $this->model = new ModelOrders();
        $this->response = new Response();
        $this->run();
    }

    public function getOrders($param=false)
    {
        try
        {
            if ($param !== false)
            {
                $result = $this->model->getOrders($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->getOrders();
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch(Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function postOrders($param)
    {
        try
        {
            $result = $this->model->addToOrders($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$books = new Orders();