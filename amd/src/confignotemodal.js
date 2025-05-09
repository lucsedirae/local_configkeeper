import Modal from 'core/modal';

export const init = async() => {
    const modal = await Modal.create({
        title: 'Config Note',
        body: '<h4>TEST BODY</h4>',
        footer: 'Test footer',
        removeOnClose: true,
    });

    await modal.show();
};
