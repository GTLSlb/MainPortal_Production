import { useState } from "react";
import { useEffect } from "react";
import MainSidebar from "../Components/Main-sidebar";
import MainNavbar from "../Components/Main-navbar";
import Gtam from "@/Pages/GTAM";
import Gtms from "@/Pages/GTMS";
import Gtw from "@/Pages/GTW";
import Gtrs from "@/Pages/GTRS";
import axios from "axios";
import Invoices from "./Invoices";
import * as signalR from "@microsoft/signalr";
import * as signalRCore from "@microsoft/signalr";

import hubConnection from "./SignalR";
// import AllRoutes from "./RoutesPage";

export default function Sidebar(Boolean) {
    const [currentUser, setcurrentUser] = useState(null);
    const [sessionData, setSessionData] = useState(null);
    const [notification, setNotification] = useState();

    const Invoicesurl = "https://gtlslebs06-vm.gtls.com.au:147/";

    useEffect(() => {
        axios
            .get("/users")
            .then((res) => {
                setcurrentUser(res.data);
            })
            .catch((error) => console.log(error));
    }, []);
    useEffect(() => {}, [currentUser]);
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [activePage, setactivePage] = useState();
    const [activeIndexGtam, setActiveIndexGtam] = useState(1);
    const [activeCon, setactiveCon] = useState(0);
    const [loadingGtrs, setLoadingGtrs] = useState(false);
    const [activeIndexGTRS, setActiveIndexGTRS] = useState(0);
    const [activeHeader, setactiveHeader] = useState("null");
    const [currentComponent, setcurrentComponent] = useState([]);
    const [activeIndexInv, setActiveIndexInv] = useState(1);
    const [invoiceDetails, setInvoiceDetails] = useState();
    const [PODetails, setPODetails] = useState();

    const components = [
        <Gtms />,
        <Gtam currentUser={currentUser} activeIndexGtam={activeIndexGtam} setActiveIndexGtam={setActiveIndexGtam} />,
        <Gtw />,
        <Gtrs
            sessionData={sessionData}
            setactivePage={setactivePage}
            setactiveCon={setactiveCon}
            setMobileMenuOpen={setMobileMenuOpen}
            mobileMenuOpen={mobileMenuOpen}
            activeHeader={activeHeader}
            activeIndexGTRS={activeIndexGTRS}
            setActiveIndexGTRS={setActiveIndexGTRS}
            loadingGtrs={loadingGtrs}
            setLoadingGtrs={setLoadingGtrs}
            currentUser={currentUser}
            setCurrentUser={setcurrentUser}
        />,
        <Invoices
            url={Invoicesurl}
            PODetails={PODetails}
            setPODetails={setPODetails}
            invoiceDetails={invoiceDetails}
            setInvoiceDetails={setInvoiceDetails}
            hubConnection={hubConnection}
            currentUser={currentUser}
            activeIndexInv={activeIndexInv}
            setActiveIndexInv={setActiveIndexInv}
        />,
    ];

    if (!currentUser) {
        return null; // Render nothing
    } else {
        return (
            <div>
                <div className="bg-smooth h-full ">
                    {/* <NmainSidebar/> */}
                    <MainSidebar
                        setMobileMenuOpen={setMobileMenuOpen}
                        setActiveIndexGtam={setActiveIndexGtam}
                        mobileMenuOpen={mobileMenuOpen}
                        activePage={activePage}
                        setactivePage={setactivePage}
                        setActiveIndexGTRS={setActiveIndexGTRS}
                        setActiveIndexInv={setActiveIndexInv}
                        currentUser={currentUser}
                    />
                    <MainNavbar
                        url={Invoicesurl}
                        currentUser={currentUser}
                        PODetails={PODetails}
                        setPODetails={setPODetails}
                        invoiceDetails={invoiceDetails}
                        setInvoiceDetails={setInvoiceDetails}
                        setActiveIndexInv={setActiveIndexInv}
                        hubConnection={hubConnection}
                        activePage={activePage}
                        setMobileMenuOpen={setMobileMenuOpen}
                        activeIndexGTRS={activeIndexGTRS}
                        mobileMenuOpen={mobileMenuOpen}
                        activeHeader={activeHeader}
                        setActiveIndexGTRS={setActiveIndexGTRS}
                        loadingGtrs={loadingGtrs}
                    />
                    {components[activePage]}
                </div>
            </div>
        );
    }
}
