<?php
namespace Qscmf\Builder\ColumnType\District;

use Illuminate\Support\Str;
use Qscmf\Builder\ColumnType\ColumnType;
use Qscmf\Builder\ColumnType\EditableInterface;
use Think\View;

class District extends ColumnType implements EditableInterface {

    use \Qscmf\Builder\ButtonType\Save\TargetFormTrait;

    public function build(array &$option, array $data, $listBuilder){
        $view = new View();
        $view->assign('value', $data[$option['name']]);
        return $view->fetch(__DIR__ . '/district.html');
    }

    public function editBuild(&$option, $data, $listBuilder){
        $class = "form-control input district ". $this->getSaveTargetForm()." {$option['extra_class']}";
        $view = new \Think\View();
        $view->assign('gid', Str::uuid());
        $view->assign('options', $option);
        $view->assign('data', $data);
        $view->assign('class', $class);
        $view->assign('level', $option['value']['level']);

        return $view->fetch(__DIR__ . '/district.html');
    }
}