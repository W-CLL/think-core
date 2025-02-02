<?php

namespace Qscmf\Builder\ColumnType\Select;

use Illuminate\Support\Str;
use Qscmf\Builder\ButtonType\Save\TargetFormTrait;
use Qscmf\Builder\ColumnType\ColumnType;
use Qscmf\Builder\ColumnType\EditableInterface;

class Select extends ColumnType implements EditableInterface{

    use TargetFormTrait;

    public function build(array &$option, array $data, $listBuilder){
        $text = $option['value'][$data[$option['name']]];
        return '<span title="' .$text. '" >' . $text . '</span>';
    }

    public function editBuild(&$option, $data, $listBuilder){
        $class = "form-control input ". $this->getSaveTargetForm(). " {$option['extra_class']}";

        $view = new \Think\View();
        $view->assign('gid', Str::uuid());
        $view->assign('options', $option);
        $view->assign('data', $data);
        $view->assign('class', $class);
        $view->assign('value', $data[$option['name']]);

        return $view->fetch(__DIR__ . '/select.html');
    }
}