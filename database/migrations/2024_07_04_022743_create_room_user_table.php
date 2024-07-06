<?php

use App\Enums\UserRoleInRoom;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId("room_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->enum("user_role_in_room", [UserRoleInRoom::USER->value, UserRoleInRoom::ADMIN->value])->default(UserRoleInRoom::USER->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_user');
    }
};
