<?php

namespace Like\Database;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LegacyFactoryBuilder {
	protected string $class;
	protected array $definitions;
	protected array $states;
	protected Faker $faker;
	protected int $amount = 1;
	protected array $activeStates = [];

	public function __construct(string $class, array $definitions, array $states, Faker $faker) {
		$this->class = $class;
		$this->definitions = $definitions;
		$this->states = $states;
		$this->faker = $faker;
	}

	/**
	 * Set the amount of models you wish to create.
	 */
	public function times(int $amount): self {
		$this->amount = $amount;
		return $this;
	}

	/**
	 * Set the states to be applied to the model.
	 */
	public function states(...$states): self {
		$this->activeStates = array_merge($this->activeStates, is_array($states[0]) ? $states[0] : $states);
		return $this;
	}

	/**
	 * Create a model and persist it to the database.
	 *
	 * @param array $attributes
	 * @return Model|Collection
	 */
	public function create(array $attributes = []) {
		$results = $this->make($attributes);

		if ($results instanceof Collection) {
			$results->each(function ($model) {
				$model->save();
			});
		} else {
			$results->save();
		}

		return $results;
	}

	/**
	 * Create a model instance.
	 *
	 * @param array $attributes
	 * @return Model|Collection
	 */
	public function make(array $attributes = []) {
		if ($this->amount === 1) {
			return $this->makeInstance($attributes);
		}

		$results = [];
		for ($i = 0; $i < $this->amount; $i++) {
			$results[] = $this->makeInstance($attributes);
		}

		return new Collection($results);
	}

	/**
	 * Make a single instance.
	 */
	protected function makeInstance(array $attributes = []): Model {
		$definition = $this->definitions[$this->class] ?? function () {
			return [];
		};

		$modelAttributes = array_merge(
			$definition($this->faker),
			$this->applyStates(),
			$attributes
		);

		return new $this->class($modelAttributes);
	}

	/**
	 * Apply the active states.
	 */
	protected function applyStates(): array {
		$stateAttributes = [];

		foreach ($this->activeStates as $state) {
			if (isset($this->states[$this->class][$state])) {
				$stateCallback = $this->states[$this->class][$state];
				$stateAttributes = array_merge($stateAttributes, $stateCallback($this->faker));
			}
		}

		return $stateAttributes;
	}
}
