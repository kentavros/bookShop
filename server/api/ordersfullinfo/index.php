<?php
include '../../app/lib/function.php';
class Ordersfullinfo extends RestServer
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
        $this->model = new ModelOrdersfullinfo();
        $this->response = new Response();
        $this->run();
    }

    public function getOrdersfullinfo($param=false)
    {
        try
        {
            if ($param !== false)
            {
                $result = $this->model->getOrdersfullinfo($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->getOrdersfullinfo();
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch(Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function postOrdersfullinfo($param)
    {
        try
        {
            $result = $this->model->addToOrdersfullinfo($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$books = new Ordersfullinfo();