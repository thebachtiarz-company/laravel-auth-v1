<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            if (tbauthconfig(AuthConfigInterface::IDENTITY_METHOD) === UserInterface::ATTRIBUTE_EMAIL) {
                $table->string(UserInterface::ATTRIBUTE_EMAIL)->unique();
                $table->timestamp(UserInterface::ATTRIBUTE_EMAIL_VERIFIED_AT)->nullable();
            }
            if (tbauthconfig(AuthConfigInterface::IDENTITY_METHOD) === UserInterface::ATTRIBUTE_USERNAME) {
                $table->string(UserInterface::ATTRIBUTE_USERNAME)->unique();
            }
            $table->string(UserInterface::ATTRIBUTE_PASSWORD);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('token_resets', function (Blueprint $table) {
            $table->id();
            $table->string(TokenResetInterface::ATTRIBUTE_TOKEN)->unique();
            $table->string(TokenResetInterface::ATTRIBUTE_USERIDENTIFIER);
            $table->timestamp(TokenResetInterface::ATTRIBUTE_EXPIRESAT)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('token_resets');
    }
};
