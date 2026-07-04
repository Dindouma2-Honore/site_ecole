<div class="modal-overlay" id="programModal" onclick="closeProgramModal(event)">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">Program Details</div>
      <button class="modal-close" onclick="closeProgramModal()">✕</button>
    </div>
    <div class="modal-body" id="modalBody"></div>
  </div>
</div>

<div class="modal-overlay" id="successModal" onclick="closeSuccessModal(event)">
  <div class="modal" style="max-width:440px;text-align:center;">
    <div class="modal-header" style="justify-content:flex-end;">
      <button class="modal-close" onclick="closeSuccessModal()">✕</button>
    </div>
    <div class="modal-body" style="padding-top:0;">
      <div style="font-size:4rem;margin-bottom:16px;">✅</div>
      <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--royal-blue);margin-bottom:10px;" lang-en>Application Submitted!</div>
      <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--royal-blue);margin-bottom:10px;" lang-fr>Candidature Soumise!</div>
      <p style="color:var(--grey-mid);font-size:0.9rem;margin-bottom:24px;" lang-en>Thank you for applying to Ambassadors Educational Complex. We will review your application and contact you within 3 business days.</p>
      <p style="color:var(--grey-mid);font-size:0.9rem;margin-bottom:24px;" lang-fr>Merci d'avoir postulé à l'Complexe Éducatif Ambassadeurs. Nous examinerons votre candidature et vous contacterons dans les 3 jours ouvrables.</p>
      <div style="background:var(--off-white);border-radius:var(--radius-md);padding:16px;margin-bottom:24px;">
        <div style="font-size:0.75rem;color:var(--grey-mid);" lang-en>Your Application Reference</div>
        <div style="font-size:0.75rem;color:var(--grey-mid);" lang-fr>Votre Référence de Candidature</div>
        <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:700;color:var(--gold);" id="appRef">EA-2026-0001</div>
      </div>
      <button class="btn btn-primary" style="width:100%;justify-content:center;" onclick="closeSuccessModal()">
        <span lang-en>Close</span><span lang-fr>Fermer</span>
      </button>
    </div>
  </div>
</div>