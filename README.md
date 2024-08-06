# This folk allow modify and saving payload of queue

# Laravel Database Queue with UUID as Primary Key

> **Problem**: With MySQL the adding a Job throws error if the datatype of `id` is `CHAR(36)` and no value is set when inserting a record.

This package provides service provider and necessary classes to allow you to insert records with `UUID` as primary key. The `UUID` is ordered and uses Laravel's `Str::orderedUuid()`.

## Install the package

To install the package use the command below

    composer require jackeratarina/laravel-uuid-database-queue

## Fresh Install of Laravel

If you have a fresh Laravel project you'll need to to create migration for `jobs` table with the following Laravel command.

    php artisan queue:table

Next open the created file with the name `create_jobs_table` in it, and make the following change

    Schema::create('jobs', function (Blueprint  $table) {
		// $table->bigIncrements('id'); // remove this line
		$table->uuid('id')->primary(); // add this line
		$table->string('displayName'); // add this line
		$table->string('queue')->index();
		$table->longText('payload');
		$table->unsignedTinyInteger('attempts');
		$table->unsignedInteger('reserved_at')->nullable();
		$table->unsignedInteger('available_at');
		$table->unsignedInteger('created_at');
	});

Continue from section [`Run Migrations`](#run-migrations)

## Existing Project With Migrated Jobs Table

> Before you add the service provider check if can see the migration `2021_10_24_161222_change_id_column_in_jobs_table` with
> `php artisan migrate:status`
> If you do see it then skip to [`Run Migrations`](#run-migrations)

In case you've already run the migration and the table exists in your database, you need to register the package service provider first. Open your project's `config/app.php` and add the following line to `providers` array.

    jackeratarina\LaravelUuidDatabaseQueue\LaravelUuidDatabaseQueueProvider::class

After this run the migration.

## Run Migrations

Now the migrations are all set to run. use the following command

    php artisan migrate

## Setup Service Provider

The final step is to replace `Illuminate\Queue\QueueServiceProvider::class` with `jackeratarina\LaravelUuidDatabaseQueue\QueueServiceProvider::class`, open `config/app.php`. Remove or comment the line `Illuminate\Queue\QueueServiceProvider::class` inside the `providers` array and add `jackeratarina\LaravelUuidDatabaseQueue\QueueServiceProvider::class`

You are all set...
