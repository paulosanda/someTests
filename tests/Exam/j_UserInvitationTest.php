<?php

namespace Tests\Exam;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * j_UserInvitationTest
 * - On this test we will check if you know how to:
 *
 * 1. Analyze a working feature and develop tests for it
 *
 * To develop your tests, you must take a look on the following files
 * - app/Http/Controllers/InvitationController.php
 * - app/Requests/Invitation
 * - app/Mail/InviteUser.php
 * - app/Models/Invitation.php
 * - routes/web.php
 */
class j_UserInvitationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_should_allow_access_to_invite_only_for_logged_users(): void
    {
        //
    }

    /** @test */
    public function it_should_check_if_email_is_filled_for_new_invitation(): void
    {
        //
    }

    /** @test */
    public function it_should_check_if_email_address_is_valid_for_new_invitation(): void
    {
        //
    }

    /** @test */
    public function it_should_check_email_size_for_new_invitation(): void
    {
        //
    }

    /** @test */
    public function it_should_create_an_invitation_and_sent_it_to_user(): void
    {
        //
    }

    /** @test */
    public function it_should_deny_invitation_acceptance_if_invitation_has_been_expired(): void
    {
        //
    }

    /** @test */
    public function it_should_deny_invitation_acceptance_if_invitation_has_been_accepted(): void
    {
        //
    }

    /** @test */
    public function it_should_check_if_email_provided_matches_with_invitation_email(): void
    {
        //
    }

    /** @test */
    public function it_should_check_if_email_already_exists_on_users_table(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_email_is_filled_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_email_address_is_valid_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_check_email_length_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_name_is_filled_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_name_is_a_string_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_check_name_min_length_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_validate_name_max_length_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_password_is_filled_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_password_was_confirmed_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_check_password_has_at_least_eight_chars_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_password_has_symbols_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_password_has_letters_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_ensure_that_password_has_numbers_for_registration(): void
    {
        //
    }

    /** @test */
    public function it_should_accept_invitation_and_create_the_new_user(): void
    {
        //
    }
}
