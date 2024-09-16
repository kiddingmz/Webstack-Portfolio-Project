import cookie from "js-cookie";

const TOKEN_NAME = "token";

export default {
    setToken(token) {
        cookie.set(TOKEN_NAME, token, { expires: 1 });
    },

    getToken() {
        return cookie.get(TOKEN_NAME);
    },

    removeToken() {
        cookie.remove(TOKEN_NAME);
    }
}
