export const forms ={
	authForm: {
		form: document.getElementById('authForm'),
		steps: document.querySelectorAll('.step-auth'),
		prevBtn: document.getElementById('prevBtnAuth'), // Cambiado a clase
		nextBtn: document.getElementById('nextBtnAuth'), // Cambiado a clase
		stepIndicators: document.getElementById('indicatorsSectionAuth'),
	},
	inscripcionForm: {
		form: document.getElementById('registerForm'),
		steps: document.querySelectorAll('.step'),
		prevBtn: document.getElementById('prevBtn'), // Cambiado a clase
		nextBtn: document.getElementById('nextBtn'), // Cambiado a clase
		stepIndicators: document.getElementById('indicatorsSection'),
	}

}