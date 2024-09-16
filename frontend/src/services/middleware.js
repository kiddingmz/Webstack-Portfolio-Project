import Cookie from "@/services/cookie";

export default {
    redirectIfNotAuthenticated(to, from, next) {
        const token = Cookie.getToken();
        let nextRoute;

        if (!token) {
            nextRoute = { name: 'login' };
        }

        next(nextRoute);
    },
    redirectIfAuthenticated(to, from, next) {
        const token = Cookie.getToken();
        let nextRoute;

        if (token) {
            nextRoute = { name: 'home' };
        }

        next(nextRoute);
    }
}
