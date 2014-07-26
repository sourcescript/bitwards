<?php  namespace SourceScript\V1\Repository;

use SourceScript\V1\Validator\ValidatorInterface;

interface RepositoryInterface {
    public function find($id);
    public function findOrFail($id);
    public function findOrFailWithTrashed($id);
    public function all();
    public function limit($start, $limit);
    public function paginate($limit);
    public function where($column, $operator, $value);
    public function with(array $relationship);
    public function withTrashed();
    public function withTrashedRelationship(array $relationship);
    public function onlyTrashed();
    public function orderBy($column, $order);
    public function getClass();
    public function create(array $inputs, ValidatorInterface $v);
    public function update(array $inputs, $id, ValidatorInterface $v);
    public function delete($id);
    public function getCurrentValidator();
    public function getCurrentErrors();
    public function getCurrentModel();
}