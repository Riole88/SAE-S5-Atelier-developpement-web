// auth.js
class AuthManager {
    constructor() {
        this.accessToken = null;
        this.refreshToken = null;
        this.userId = null;
    }

    setAuth(payload, profile) {
        this.accessToken = payload.access_token;
        this.refreshToken = payload.refresh_token;
        this.userId = profile.id;

        // 🔍 LOG pour debug
        console.log('✅ Auth configuré:');
        console.log('   - accessToken:', this.accessToken ? 'présent' : 'absent');
        console.log('   - userId:', this.userId);
    }

    getUserId() {
        console.log('🔍 getUserId appelé:', this.userId);
        return this.userId;
    }

    isAuthenticated() {
        const auth = this.accessToken !== null;
        console.log('🔍 isAuthenticated:', auth);
        return auth;
    }

    clearAuth() {
        this.accessToken = null;
        this.refreshToken = null;
        this.userId = null;
    }

    getAuthHeaders() {
        if (!this.accessToken) {
            throw new Error('Non authentifié');
        }
        const headers = {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this.accessToken}`
        };

        // 🔍 LOG pour debug
        console.log('🔍 Headers envoyés:', {
            'Authorization': headers.Authorization.substring(0, 30) + '...'
        });

        return headers;
    }
}

export default new AuthManager();