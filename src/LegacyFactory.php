<?php

namespace Like\Database;

use Faker\Generator as Faker;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;

class LegacyFactory {
	protected Faker $faker;
	protected array $definitions = [];
	protected array $states = [];
	protected array $afterMaking = [];
	protected array $afterCreating = [];

	public function __construct(Faker $faker) {
		$this->faker = $faker;
	}

	/**
	 * Load factories from the given path.
	 */
	public function load(string $path): void {
		if (!is_dir($path)) {
			return;
		}

		$finder = new Finder();
		$finder->files()->name('*.php')->in($path);

		foreach ($finder as $file) {
			require $file->getRealPath();
		}
	}

	/**
	 * Define a class with a given set of attributes.
	 */
	public function define(string $class, callable $attributes): self {
		$this->definitions[$class] = $attributes;
		return $this;
	}

	/**
	 * Define a state with a given set of attributes.
	 */
	public function state(string $class, string $state, callable $attributes): self {
		$this->states[$class][$state] = $attributes;
		return $this;
	}

	/**
	 * Create a new factory instance for a given model.
	 */
	public function of(string $class): LegacyFactoryBuilder {
		return new LegacyFactoryBuilder($class, $this->definitions, $this->states, $this->faker);
	}

	/**
	 * Register an after making callback.
	 */
	public function afterMaking(string $class, callable $callback): self {
		$this->afterMaking[$class][] = $callback;
		return $this;
	}

	/**
	 * Register an after creating callback.
	 */
	public function afterCreating(string $class, callable $callback): self {
		$this->afterCreating[$class][] = $callback;
		return $this;
	}

	/**
	 * Get the after making callbacks for a given model.
	 */
	public function getAfterMaking(string $class): array {
		return $this->afterMaking[$class] ?? [];
	}

	/**
	 * Get the after creating callbacks for a given model.
	 */
	public function getAfterCreating(string $class): array {
		return $this->afterCreating[$class] ?? [];
	}
}
