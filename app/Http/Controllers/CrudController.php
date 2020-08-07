<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Onlinist\Json2query\Facade\Json2queryFacade as Json2query;

class CrudController extends Controller {

    protected $model;

    public function list(Request $request) {
        $json2query = Json2query::init($this->model, $request->filter);
        $json2query->buildQuery();
        $json2query->buildResult($request->limit, $request->page);
        $result = $json2query->result();
        $meta = $json2query->meta();

        $return = func_num_args() >= 2 ? func_get_arg(1) : false;
        if ($return) {
            return $json2query;
        }

        return $this->listResponse($result, $meta);
    }

    public function get($id, Request $request) {
        $json2query = Json2query::init($this->model, $request->filter);
        $json2query->buildQuery();
        $query = $json2query->query();
        $result = $query->find($id);

        $return = func_num_args() >= 3 ? func_get_arg(2) : false;
        if ($return) {
            return $result;
        }

        $meta = array(
            'query' => $query->toSql()
        );
        return $this->success($result, 200, null, $meta);
    }

    public function getOne(Request $request) {
        $json2query = Json2query::init($this->model, $request->filter);
        $json2query->buildQuery();
        $query = $json2query->query();
        $result = $query->first();

        $return = func_num_args() >= 2 ? func_get_arg(1) : false;
        if ($return) {
            return $result;
        }

        return $this->success($result);
    }

    public function count(Request $request) {
        $json2query = Json2query::init($this->model, $request->filter);
        $json2query->buildWhere();
        $query = $json2query->query();
        $result = $query->count();

        $return = func_num_args() >= 2 ? func_get_arg(1) : false;
        if ($return) {
            return $json2query;
        }

        $meta = array(
            'query' => $query->toSql()
        );
        return $this->success($result, 200, null, $meta);
    }

    public function create(Request $request) {
        $this->validate($request, $this->model::createRules());
        $input = $request->all();
        $record = $this->model::create($input);

        $return = func_num_args() >= 2 ? func_get_arg(1) : false;
        if ($return) {
            return $record;
        }

        return $this->success($record, 201, 'Record has been added successfully');
    }

    public function update($id, Request $request) {
        $record = $this->model::findOrFail($id);
        $this->validate($request, $this->model::updateRules($record));
        $updatable = $request->only($this->model::$updatable);
        foreach ($updatable as $attribute => $value) {
            $record->$attribute = $value;
        }
        $record->save();

        $return = func_num_args() >= 3 ? func_get_arg(2) : false;
        if ($return) {
            return $record;
        }

        return $this->success($record, 200, 'Record has been updated successfully');
    }

    public function delete($id, Request $request) {
        $record = $this->model::findOrFail($id);
        $record->delete();

        $return = func_num_args() >= 3 ? func_get_arg(2) : false;
        if ($return) {
            return $record;
        }

        return $this->success($record, 200, 'Record has been deleted successfully');
    }

    public function forceDelete($id, Request $request) {
        $record = $this->model::withTrashed()->findOrFail($id);
        $record->forceDelete();

        $return = func_num_args() >= 3 ? func_get_arg(2) : false;
        if ($return) {
            return $record;
        }

        return $this->success($record, 200, 'Record has been permanently deleted');
    }

    public function restore($id, Request $request) {
        $record = $this->model::onlyTrashed()->findOrFail($id);
        $record->restore();

        $return = func_num_args() >= 3 ? func_get_arg(2) : false;
        if ($return) {
            return $record;
        }

        return $this->success($record, 200, 'Record has been restored successfully');
    }

}
