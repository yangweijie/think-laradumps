<?php

namespace think\Laradumps\Payloads;

use think\Model;
use think\Laradumps\Support\Dumper;

class ModelPayload extends Payload
{
    protected $model;

    public function __construct(
        $model
    ) {
        $this->model = $model;
    }

    public function type(): string
    {
        return 'model';
    }

    /** @return array<string, array|string> */
    public function content(): array
    {
        $relations = $this->model->getRelation();

        return [
            'relations'  => $relations ? Dumper::dump($relations) : [],
            'className'  => get_class($this->model),
            'attributes' => Dumper::dump($this->modelAttributes($this->model)),
        ];
    }

    public function modelAttributes($model){
        $data    = $model->getData();
        $orign   = $model->getOrigin();
        if($data == $orign){
            return $data;
        }else{
            $ret = [];
            foreach ($data as $key => $value) {
                $ret[$key] = $model->getAttr($value);
            }
            return $ret;
        }
    }
}