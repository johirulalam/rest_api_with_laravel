<?php 


namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser {

	private function successResponse($data, $code){
		return response()->json($data, $code);
	}

	protected function errorResponse($message, $code) {
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	protected function showAll(Collection $collection, $code = 200) {
		$collection = $this->filterData($collection);
		$collection = $this->sortData($collection);
		$collection = $this->paginate($collection);
		return $this->successResponse($collection, $code);
	}

	protected function showOne(Model $model, $code = 200) {
		return $this->successResponse($model, $code);
	}

	protected function ShowMessage($message, $code = 200) {
		return $this->successResponse(['data' => $message], $code);
	}

	protected function sortData(Collection $collection){
		if(request()->has('sort_by')) {
			$attribute = $this->originalAttribute(request()->sort_by);
			$collection = $collection->sortBy($attribute);
		}
		return $collection;
	}

	protected function filterData(Collection $collection){
		foreach (request()->query() as $query => $value) {
			$attribute = $this->originalAttribute($query);
			if (isset($attribute, $value)) {
				$collection = $collection->where($query, $value);
			}
		}

		return $collection;
	}

	protected function paginate(Collection $collection){
		request()->validate([
			'per_page' => 'integer|min:5|max:50',
		]);

		$perPage = 15;
		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
		}
		$page = LengthAwarePaginator::resolveCurrentPage();
		$results = $collection->slice($page - 1 * $perPage, $perPage)->values();
		$paginatd = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPage(),
		]);

		return $paginatd;
	}

	protected function originalAttribute($queryAttribute){
		$attributes = [
			'id' => 'id',
			'name' => 'name',
			'email' => 'email',
			'verified' => 'verified',
			'admin' => 'admin',
			'delete_at'=> 'delete_at',
			'update_at' => 'update_at',
			'created_at' => 'created_at',
		];

		return isset($attributes[$queryAttribute]) ? $attributes[$queryAttribute] : null;
	}

}