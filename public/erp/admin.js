function getAdminLayouts() {
    return {
        /*
         * CenterLayout demo panel
         */
        admin: {
            id: 'admin-panel',
            title: 'Admin ',
            layout: 'fit',
            autoScroll: true,
            bodyPadding: 15,
            contentEl: 'admin-div',
            renderTo: Ext.getBody()
        }
    };

}
