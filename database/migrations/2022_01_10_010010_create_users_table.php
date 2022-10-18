<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\Auth\Interfaces\Model\UserModelInterface;

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
            if (tbauthconfig('user_auth_identity_method') === UserModelInterface::USER_ATTRIBUTE_EMAIL) {
                $table->string(UserModelInterface::USER_ATTRIBUTE_EMAIL)->unique();
                $table->timestamp(UserModelInterface::USER_ATTRIBUTE_EMAIL_VERIFIED_AT)->nullable();
            }
            if (tbauthconfig('user_auth_identity_method') === UserModelInterface::USER_ATTRIBUTE_USERNAME) {
                $table->string(UserModelInterface::USER_ATTRIBUTE_USERNAME)->unique();
            }
            $table->string(UserModelInterface::USER_ATTRIBUTE_PASSWORD);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
    }
};
