"use client";

import { createContext, useContext, useState } from "react";

export const TokenContext = createContext("");

export const TokenProvider = ({ children }) => {
    const [token, setToken] = useState("");

    return (
        <TokenContext.Provider value={{ token, setToken }}>
            {children}
        </TokenContext.Provider>
    );
};

export const useToken = () => useContext(TokenContext);
