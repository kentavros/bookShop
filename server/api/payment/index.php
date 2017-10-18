<?php
include '../../app/lib/function.php';
class Payment extends RestServer
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
        $this->model = new ModelPayment();
        $this->response = new Response();
        $this->run();
    }

    public function getPayment($param=false)
    {
        try
        {
            if ($param !== false)
            {
                $result = $this->model->getPayment($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->getPayment();
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch(Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }

    }
}
$books = new Payment();