/**
 * Author: Héctor Zaragoza Arranz
 * Date: 13/02/2020
 */
LoginModal = {
    FORMS: {
        'LOGIN': 1,
        'REGISTER': 2
    },

    actualForm: null,
    $modal: null,

    initialize: function () {
        LoginModal.actualForm = LoginModal.FORMS.LOGIN;
        LoginModal.$modal = $('#loginModal');
        LoginModal.$modal.find('#registerFooter').hide();
        LoginModal.$modal.find('#registerTitle').hide();
        LoginModal.$modal.find('#registerForm').hide();
        LoginModal.assignEvents();
    },

    assignEvents: function () {
        $('#modalRegisterBtn, #modalLoginBtn').on('click', function () {
            LoginModal.toggleForms();
        });
    },

    toggleForms: function () {
        if(LoginModal.actualForm === LoginModal.FORMS.LOGIN) {
            LoginModal.showRegisterForm();
        } else if(LoginModal.actualForm === LoginModal.FORMS.REGISTER) {
            LoginModal.showLoginForm();
        }
    },

    showRegisterForm: function () {
        LoginModal.actualForm = LoginModal.FORMS.REGISTER;
        LoginModal.$modal.find('.modal-dialog').addClass('modal-lg');
        LoginModal.$modal.find('#loginForm').fadeOut(300, function () {
            LoginModal.$modal.find('#registerForm').fadeIn(300);
            LoginModal.$modal.find('#loginFooter').hide();
            LoginModal.$modal.find('#loginTitle').hide();
            LoginModal.$modal.find('#registerFooter').show();
            LoginModal.$modal.find('#registerTitle').show();
        });
    },

    showLoginForm: function() {
        LoginModal.actualForm = LoginModal.FORMS.LOGIN;
        LoginModal.$modal.find('.modal-dialog').removeClass('modal-lg');
        LoginModal.$modal.find('#registerForm').fadeOut(300, function () {
            LoginModal.$modal.find('#loginForm').fadeIn(300);
            LoginModal.$modal.find('#registerFooter').hide();
            LoginModal.$modal.find('#registerTitle').hide();
            LoginModal.$modal.find('#loginFooter').show();
            LoginModal.$modal.find('#loginTitle').show();
        });
    }
};