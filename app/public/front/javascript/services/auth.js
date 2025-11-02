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
    }

    getUserId() {
        return this.userId;
    }

    isAuthenticated() {
        const auth = this.accessToken !== null;
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

        return headers;
    }
}

export default new AuthManager();