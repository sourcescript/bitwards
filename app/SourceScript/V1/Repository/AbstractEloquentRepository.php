<?php  namespace SourceScript\V1\Repository;

use SourceScript\V1\Validator\ValidatorInterface;

abstract class AbstractEloquentRepository implements RepositoryInterface {

    protected $currentModel;
    protected $validator;
    protected $class;

    public function __construct(Eloquent $class) {
        $this->class = $class;
    }

    public function create(array $input, ValidatorInterface $v)
    {
        $this->validator = $v;

        if ($v->validate($input))
        {
            return $this->currentModel = $this->class->create($input);
        }

        return false;
    }

    public function update(array $input, $id, ValidatorInterface $v)
    {
        $this->currentModel = $this->class->withTrashed()->findOrFail($id);
        $this->validator = $v;

        if ($v->validate($input))
        {
            $this->currentModel->update($input);

            return $this->currentModel;
        }

        return false;
    }

    public function delete($id)
    {
        $this->currentModel = $this->class->findOrFail($id);

        return $this->currentModel->delete();
    }

    public function getCurrentValidator()
    {
        return $this->validator;
    }

    public function getCurrentErrors()
    {
        if ($this->validator)
            return $this->validator->getCurrentErrors();

        return [];
    }

    public function getCurrentModel()
    {
        return $this->currentModel;
    }

    public function getClassName()
    {
        return $this->class;
    }

    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function restoreDeleted($id)
    {
        $model = $this->class->onlyTrashed()->findOrFail($id);

        return $model->restore();
    }

    public function find($id)
    {
        return $this->class->find($id);
    }

    public function findOrFail($id)
    {
        return $this->class->findOrFail($id);
    }

    public function findOrFailWithTrashed($id)
    {
        return $this->class->withTrashed()->findOrFail($id);
    }

    public function all()
    {
        return $this->class->all();
    }

    public function limit($start, $limit)
    {
        return $this->class->skip($start)->take($limit);
    }

    public function with(array $relationship)
    {
        return $this->class->with($relationship);
    }

    public function withTrashed()
    {
        return $this->class->withTrashed();
    }

    public function withTrashedRelationship(array $relationship)
    {
        $rel = [];

        foreach ($relationship as $relationshipName)
        {
            $rel[$relationshipName] = function($query)
            {
                $query->withTrashed();
            };
        }

        return $this->with($rel);
    }

    public function paginate($limit)
    {
        return $this->class->paginate($limit);
    }

    public function where($column, $operator, $value)
    {
        return $this->class->where($column, $operator, $value);
    }

    public function orderBy($column, $order)
    {
        return $this->class->orderBy($column, $order);
    }

    public function onlyTrashed()
    {
        return $this->onlyTrashed();
    }
}