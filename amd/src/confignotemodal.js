import Modal from 'core/modal';

export const init = async(table) => {
    const modal = await Modal.create({
        title: 'Config Note',
        body: table,
        footer: 'Test footer',
        removeOnClose: true,
        large: true,
    });

    window.console.log('body', table);
    await modal.show();
};
