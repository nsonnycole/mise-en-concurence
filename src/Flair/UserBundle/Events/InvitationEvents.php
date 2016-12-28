<?php

namespace Flair\UserBundle\Events;

/**
 * Collection avec les evenements liés à l'invitation d'un prestataire.
 */
class InvitationEvents
{
    /**
     * @const String Nouvelle invitation envoyé
     */
    const NEW_INVITATION = 'flair.event.invitations.new';

    /**
     * @const String L'invitation a été accepté par le prestataire.
     */
    const INVITATION_ACCEPTED = 'flair.event.invitations.accepted';

    /**
     * @const Relance de l'invitation resté sans réponse.
     */
    const RENEW_INVITATION = 'flair.event.invitations.renew';

    /**
     * @const Refuse une invitation
     */
    const REFUSE_INVITATION = 'flair.event.invitations.refused';
}
