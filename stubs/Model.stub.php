<?php

namespace Admin\{{moduleName}}\Models;

use Illuminate\Database\Eloquent\Model;

class {{modelName}} extends Model {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = '{{modelNamePluralLowerCase}}';

	/**
	 * Guarded attirbutes
	 * @var array
	 */
	protected $fillable = ['id'];

	/**
	 * Hidden attirbutes
	 * @var array
	 */
	protected $hidden = ['created_at', 'updated_at'];

    /**
     * The others that belong to this OtherModel.
     */
    // public function othermodel()
    // {
    //     return $this->hasMany('Admin\{{moduleName}}\Models\Other', 'other_id');
    // }
}